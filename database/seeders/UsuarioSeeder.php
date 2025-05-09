<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use App\Models\Usuario;
use Illuminate\Support\Str; // Asegúrate que Str esté importado
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
// use Illuminate\Support\Arr; // No necesitamos Arr::except finalement

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');
        $totalUsuariosACrear = 64513;

        $unidadesAcademicasIds = DB::table('UnidadAcademica')->pluck('idUnidadAcademica')->toArray();

        if (empty($unidadesAcademicasIds)) {
            $this->command->error('Error: No se encontraron registros en la tabla UnidadAcademica. Ejecuta primero UnidadAcademicaSeeder.');
            return;
        }
        $this->command->info('Se usarán ' . count($unidadesAcademicasIds) . ' Unidades Académicas encontradas en la BD.');

        $todasLasCategorias = ['AlumnoBachillerato', 'AlumnoLicenciatura', 'AlumnoPosgrado', 'Investigador', 'Docente', 'Administrativo', 'Externo'];
        $categoriasNoAdmin = array_filter($todasLasCategorias, fn($cat) => $cat !== 'Administrativo');
        if (empty($categoriasNoAdmin)) {
             $this->command->warn("Advertencia: La lista de categorías no administrativas está vacía. Usando 'Externo' como fallback.");
             $categoriasNoAdmin = ['Externo'];
        }

        $estadosVerificados = ['Activo', 'Inactivo', 'Suspendido']; // Estados posibles si está verificado
        $estadoAdminRequerido = 'Activo'; // Estado específico para Admin
        $estadoPendiente = 'PendienteConfirmacion';
        $dominios = ['@alumno.ipn.mx', '@ipn.mx'];
        $dominioAdminRequerido = '@ipn.mx'; // Dominio específico para Admin

        $usuariosCreados = 0;
        $intentosMaximosTotales = $totalUsuariosACrear * 5;
        $intentosActualesTotales = 0;

        $usuariosParaInsertar = [];
        $emailsEnChunkActual = [];
        $tamanoChunk = 500;

        $progressBar = $this->command->getOutput()->createProgressBar($totalUsuariosACrear);
        $progressBar->start();

        while ($usuariosCreados < $totalUsuariosACrear && $intentosActualesTotales < $intentosMaximosTotales) {
            $intentosActualesTotales++;
            // Reset flags
            $usuarioValido = $boletaValida = $emailValido = false;

            // --- Generación básica de datos ---
            $nombre = $faker->firstName;
            $pApellido = str_replace(' ', '', $faker->lastName);
            $sApellido = $faker->optional(0.7)->lastName;
            if ($sApellido) { $sApellido = str_replace(' ', '', $sApellido); }

            $boleta = null;
            $email = null;
            $dominioEmail = null; // Para guardar el dominio usado

            // --- Generar Boleta Única ---
            // (Lógica sin cambios)
            $intentosBoleta = 0;
            while($intentosBoleta < 2) {
                $intentosBoleta++;
                $boletaTemporal = ($intentosBoleta == 1) ? '2023'.$faker->numerify('######') : $faker->unique()->numerify('##########');
                if (!isset($usuariosParaInsertar[$boletaTemporal]) && !DB::table('usuarios')->where('boleta', $boletaTemporal)->exists()) {
                    $boleta = $boletaTemporal; $boletaValida = true; break;
                }
            }
            $faker->unique(true);
            if (!$boletaValida) { continue; }

            // --- Generar Email Único (con dominio aleatorio inicial) ---
             try {
                $letra1 = mb_substr($nombre, 0, 1); $apellido1 = Str::slug($pApellido, '');
                $letra2 = '';
                if (!empty($sApellido)) { $letra2 = mb_substr($sApellido, 0, 1); }
                elseif (mb_strlen($nombre) > 1) { $letra2 = mb_substr($nombre, 1, 1); }
                else { $letra2 = $faker->randomLetter; }
                $letra1 = Str::slug($letra1, ''); $letra2 = Str::slug($letra2, '');
                $intentosEmail = 0; $maxIntentosEmail = 10;
                while($intentosEmail < $maxIntentosEmail) {
                    $intentosEmail++;
                    $numero = $faker->numberBetween(10, 9999);
                    $dominio = $faker->randomElement($dominios); // Dominio aleatorio aquí
                    $emailTemporal = mb_strtolower($letra1 . $apellido1 . $letra2 . $numero . $dominio);
                    if (!isset($emailsEnChunkActual[$emailTemporal]) && !DB::table('usuarios')->where('email', $emailTemporal)->exists()) {
                        $email = $emailTemporal;
                        $dominioEmail = $dominio; // Guardar el dominio que se usó
                        $emailValido = true;
                        break;
                    }
                }
                if (!$emailValido) { continue; }
            } catch (\Exception $e) {
                $this->command->warn("\nError generando email para {$nombre} {$pApellido}: " . $e->getMessage());
                continue;
            }

            $usuarioValido = $boletaValida && $emailValido;

            // --- Determinar Estado Verificación Inicial y Categoría Potencial ---
            $createdAt = $faker->dateTimeBetween('-2 years', '-1 second');
            $emailVerifiedAt = null;
            $estadoUsuarioInicial = $estadoPendiente; // Estado base
            $categoriaUsuarioPotencial = null;

            $seraVerificado = $faker->boolean(80);

            if ($seraVerificado) {
                $emailVerifiedAt = $faker->dateTimeBetween($createdAt, 'now');
                // Estado inicial si está verificado (puede cambiar si es Admin)
                $estadoUsuarioInicial = $faker->randomElement($estadosVerificados);
                // Puede ser CUALQUIER categoría inicialmente
                $categoriaUsuarioPotencial = $faker->randomElement($todasLasCategorias);
            } else {
                // No verificado: estado pendiente, NUNCA Admin
                $emailVerifiedAt = null;
                $estadoUsuarioInicial = $estadoPendiente;
                $categoriaUsuarioPotencial = $faker->randomElement($categoriasNoAdmin);
            }

            // --- Aplicar Reglas Estrictas para Administrativos y Finalizar Datos ---
            $categoriaUsuarioFinal = $categoriaUsuarioPotencial; // Empezar con la categoría potencial
            $estadoUsuarioFinal = $estadoUsuarioInicial;       // Empezar con el estado inicial
            $idRolAdmin = null;                               // Rol por defecto null

            if ($categoriaUsuarioPotencial === 'Administrativo') {
                // Si potencialmente es Admin, verificar TODAS las condiciones extras
                if ($dominioEmail === $dominioAdminRequerido) {
                    // Dominio es correcto (@ipn.mx)! Forzar estado 'Activo' y asignar rol
                    $estadoUsuarioFinal = $estadoAdminRequerido; // Forzar estado
                    $idRolAdmin = $faker->numberBetween(2, 6);    // Asignar rol
                    // La categoría se mantiene como 'Administrativo'
                } else {
                    // Dominio INCORRECTO! No puede ser Admin.
                    // Cambiar a una categoría no-admin.
                    // Mantener el estado verificado aleatorio ($estadoUsuarioInicial) que ya tenía.
                    $categoriaUsuarioFinal = $faker->randomElement($categoriasNoAdmin);
                    // $idRolAdmin permanece null
                    // $estadoUsuarioFinal permanece como $estadoUsuarioInicial (que será Activo/Inactivo/Suspendido)
                }
            }
            // Si la categoría potencial no era 'Administrativo', no se hace nada más.
            // $categoriaUsuarioFinal, $estadoUsuarioFinal, $idRolAdmin quedan con sus valores iniciales/por defecto.


            // --- Preparar datos finales para inserción ---
            if ($usuarioValido) {
                $usuariosParaInsertar[$boleta] = [
                    'id' => Str::uuid()->toString(),
                    'nombre' => $nombre,
                    'p_apellido' => $pApellido,
                    's_apellido' => $sApellido,
                    'boleta' => $boleta,
                    'email' => $email, // El email generado (con su dominio original)
                    'email_verified_at' => $emailVerifiedAt,
                    'password' => 'password', // O Hash::make('password')
                    'idUnidadAcademica' => $faker->randomElement($unidadesAcademicasIds),
                    'categoriaUsuario' => $categoriaUsuarioFinal, // La categoría final después de las reglas
                    'estadoUsuario' => $estadoUsuarioFinal,      // El estado final después de las reglas
                    'idRolAdmin' => $idRolAdmin,             // El rol final después de las reglas
                    'created_at' => $createdAt,
                    'updated_at' => $emailVerifiedAt ?? $createdAt,
                ];

                $emailsEnChunkActual[$email] = true;
                $usuariosCreados++;
                $progressBar->advance();

                // Insertar chunk
                if (count($usuariosParaInsertar) >= $tamanoChunk) {
                    try { DB::table('usuarios')->insert(array_values($usuariosParaInsertar)); }
                    catch (\Illuminate\Database\QueryException $ex) { $this->command->error("\nError BD chunk: ".$ex->getMessage()); }
                    $usuariosParaInsertar = []; $emailsEnChunkActual = [];
                }
            }
        } // Fin while

        // Insertar último chunk
        if (!empty($usuariosParaInsertar)) {
             try { DB::table('usuarios')->insert(array_values($usuariosParaInsertar)); }
             catch (\Illuminate\Database\QueryException $ex) { $this->command->error("\nError BD último chunk: ".$ex->getMessage()); }
        }

        $progressBar->finish();
        $this->command->info("");

        if ($usuariosCreados < $totalUsuariosACrear) {
            $this->command->warn("Advertencia: Solo se pudieron preparar $usuariosCreados / $totalUsuariosACrear usuarios únicos después de $intentosActualesTotales intentos.");
        } else {
            $this->command->info("¡Seeder UsuarioSeeder completado! Se insertaron $usuariosCreados usuarios.");
        }
    }
}