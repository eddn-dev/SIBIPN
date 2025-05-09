<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission; // Importar modelo Permission
use Illuminate\Support\Facades\DB; // Para usar DB::table si se prefiere

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Pobla la tabla permissions con todos los permisos definidos para el sistema.
     */
    public function run(): void
    {
        // Opcional: Vaciar la tabla primero para asegurar un estado limpio al re-ejecutar.
        // ¡Cuidado en producción! Esto borraría cualquier permiso añadido manualmente.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Deshabilitar FKs temporalmente si hay relaciones
        DB::table('permissions')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Habilitar FKs de nuevo

        // Definición de todos los permisos con grupo y descripción
        $permissions = [
            // --- Grupo: Global ---
            ['name' => '*', 'group' => 'Global', 'description' => 'Acceso total a todas las funcionalidades (Super Administrador).'],

            // --- Grupo: Usuarios y Roles (GES-USR) ---
            ['name' => 'usuarios:crud', 'group' => 'Usuarios', 'description' => 'Permiso general para Crear, Ver, Editar y Eliminar usuarios.'],
            ['name' => 'usuarios:ver_basico', 'group' => 'Usuarios', 'description' => 'Ver información básica de usuarios (para circulación, etc.).'],
            ['name' => 'usuarios:asignar_rol', 'group' => 'Usuarios', 'description' => 'Asignar o quitar roles administrativos a usuarios Staff.'],
            ['name' => 'usuarios:crear', 'group' => 'Usuarios', 'description' => 'Crear nuevas cuentas de usuario (generalmente Staff desde admin).'],
            ['name' => 'usuarios:eliminar', 'group' => 'Usuarios', 'description' => 'Eliminar cuentas de usuario (permiso delicado).'],
            ['name' => 'usuarios:gestionar_bloqueos', 'group' => 'Usuarios', 'description' => 'Aplicar o levantar bloqueos/suspensiones a usuarios.'],
            ['name' => 'roles:crud', 'group' => 'Roles', 'description' => 'Gestionar roles y asignar permisos a los roles.'],

            // --- Grupo: Catálogo (GES-CAT, GES-ITE) ---
            ['name' => 'catalogo:registros_bib:crud', 'group' => 'Catálogo', 'description' => 'Crear, ver, editar y eliminar registros bibliográficos (MARC).'],
            ['name' => 'catalogo:registros_bib:import_export', 'group' => 'Catálogo', 'description' => 'Importar y exportar registros bibliográficos en lote.'],
            ['name' => 'catalogo:autoridades:crud', 'group' => 'Catálogo', 'description' => 'Gestionar registros de autoridad (autores, temas, series).'],
            ['name' => 'catalogo:items:crud', 'group' => 'Catálogo', 'description' => 'Crear, ver, editar y eliminar registros de ítems/ejemplares.'],
            ['name' => 'catalogo:items:asignar_id', 'group' => 'Catálogo', 'description' => 'Asignar identificadores únicos (códigos de barras) a ítems.'],
            ['name' => 'catalogo:items:gestionar_ubicacion_estado', 'group' => 'Catálogo', 'description' => 'Modificar la ubicación física y el estado de los ítems.'],
            ['name' => 'catalogo:inventario:participar', 'group' => 'Catálogo', 'description' => 'Participar en procesos de inventario físico.'],

             // --- Grupo: Circulación (GES-CIR) ---
            ['name' => 'circulacion:prestamo', 'group' => 'Circulación', 'description' => 'Realizar el préstamo (check-out) de ítems.'],
            ['name' => 'circulacion:devolucion', 'group' => 'Circulación', 'description' => 'Registrar la devolución (check-in) de ítems.'],
            ['name' => 'circulacion:renovacion', 'group' => 'Circulación', 'description' => 'Renovar préstamos existentes.'],
            ['name' => 'circulacion:gestion_reservas', 'group' => 'Circulación', 'description' => 'Gestionar reservas (colocar, cancelar, notificar).'],
            ['name' => 'circulacion:prestamo_especial', 'group' => 'Circulación', 'description' => 'Registrar préstamos especiales (sala, horas).'],
            ['name' => 'circulacion:prestamo_interbib_basico', 'group' => 'Circulación', 'description' => 'Gestionar préstamos interbibliotecarios básicos.'],

            // --- Grupo: Multas (GES-FIN) ---
             ['name' => 'multas:registrar_pago', 'group' => 'Multas', 'description' => 'Registrar pagos de multas y tarifas.'],
             ['name' => 'multas:ver_usuario', 'group' => 'Multas', 'description' => 'Ver las multas pendientes de un usuario.'],
             ['name' => 'multas:condonar', 'group' => 'Multas', 'description' => 'Condonar (perdonar) multas o tarifas (permiso elevado).'],
             ['name' => 'multas:registrar_manual', 'group' => 'Multas', 'description' => 'Registrar manualmente tarifas (daño, pérdida, etc.).'],

            // --- Grupo: Adquisiciones y Donaciones (GES-ADQ, GES-DON) ---
            ['name' => 'adquisiciones:proveedores:crud', 'group' => 'Adquisiciones', 'description' => 'Gestionar información de proveedores.'],
            ['name' => 'adquisiciones:ordenes:crud', 'group' => 'Adquisiciones', 'description' => 'Crear y gestionar órdenes de compra.'],
            ['name' => 'adquisiciones:presupuestos:gestionar', 'group' => 'Adquisiciones', 'description' => 'Gestionar presupuestos de adquisición.'],
            ['name' => 'adquisiciones:recepcion:registrar', 'group' => 'Adquisiciones', 'description' => 'Registrar la recepción de materiales.'],
            ['name' => 'donaciones:crud', 'group' => 'Donaciones', 'description' => 'Gestionar el proceso completo de donaciones.'],

            // --- Grupo: Formación (FOR-GCO) ---
            ['name' => 'formacion:contenido:crud', 'group' => 'Formación', 'description' => 'Crear, editar y publicar contenido formativo.'],
            ['name' => 'formacion:categorias:crud', 'group' => 'Formación', 'description' => 'Gestionar categorías de contenido formativo.'],
            ['name' => 'formacion:eventos:crud', 'group' => 'Formación', 'description' => 'Crear y gestionar eventos formativos (talleres, webinars).'],
            ['name' => 'formacion:inscripciones:gestionar', 'group' => 'Formación', 'description' => 'Gestionar inscripciones a eventos.'],
            ['name' => 'formacion:evaluaciones:crud', 'group' => 'Formación', 'description' => 'Crear y gestionar cuestionarios/evaluaciones.'],
            ['name' => 'formacion:progreso:ver', 'group' => 'Formación', 'description' => 'Ver el progreso de los usuarios en cursos.'],
            ['name' => 'formacion:certificados:emitir', 'group' => 'Formación', 'description' => 'Emitir certificados de finalización.'],

            // --- Grupo: Comunidad (COM-GFG) ---
            ['name' => 'comunidad:gestionar_foros', 'group' => 'Comunidad', 'description' => 'Crear, editar y eliminar categorías y foros de discusión.'],
            ['name' => 'comunidad:moderar_posts', 'group' => 'Comunidad', 'description' => 'Moderar (editar, eliminar, mover) publicaciones en foros.'],
            ['name' => 'comunidad:gestionar_grupos', 'group' => 'Comunidad', 'description' => 'Gestionar la creación y configuración de grupos de estudio.'],
            ['name' => 'comunidad:gestionar_miembros_grupo', 'group' => 'Comunidad', 'description' => 'Añadir/eliminar miembros de grupos.'],
            ['name' => 'comunidad:atender_reportes', 'group' => 'Comunidad', 'description' => 'Gestionar reportes de contenido inapropiado.'],

            // --- Grupo: Configuración (GES-CFG) ---
            // Nota: 'config:*' no se lista aquí ya que no es un permiso real asignable,
            // sino un patrón que se puede chequear en los Gates si se desea dar acceso general.
            // Opcionalmente, puedes crear un permiso 'config:ver' si quieres controlar solo el acceso.
            ['name' => 'config:gestionar-configuracion', 'group' => 'Configuración', 'description' => 'Acceso general para ver/editar la configuración.'], // Permiso usado en rutas
            ['name' => 'config:bibliotecas:crud', 'group' => 'Configuración', 'description' => 'Gestionar información de las bibliotecas participantes.'],
            ['name' => 'config:politicas:crud', 'group' => 'Configuración', 'description' => 'Definir y configurar políticas de circulación.'],
            ['name' => 'config:ubicaciones:crud', 'group' => 'Configuración', 'description' => 'Gestionar ubicaciones físicas dentro de las bibliotecas.'],
            ['name' => 'config:parametros:gestionar', 'group' => 'Configuración', 'description' => 'Gestionar parámetros generales del sistema.'],

             // --- Grupo: Reportes (GES-REP) ---
             ['name' => 'reportes:ver', 'group' => 'Reportes', 'description' => 'Ver y generar reportes del sistema.'],

        ];

        // Insertar usando el modelo (maneja created_at/updated_at si $timestamps = true)
        // O usar DB::table('permissions')->insert($permissions); si $timestamps = false
        Permission::insert($permissions); // Más eficiente para inserción masiva sin timestamps

        // Mensaje en consola (opcional)
        $this->command->info('Tabla permissions poblada con '. count($permissions) .' permisos definidos.');
    }
}
