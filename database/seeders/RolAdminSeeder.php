<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\RolAdmin; // Importar el modelo RolAdmin
use App\Models\Permission; // Importar el modelo Permission

class RolAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Pobla la tabla rol_admin y la tabla pivote permission_role.
     */
    public function run(): void
    {
        // Deshabilitar FKs temporalmente para vaciar tablas relacionadas si es necesario
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Vaciar la tabla pivote y la tabla de roles
        DB::table('permission_role')->delete();
        DB::table('rol_admin')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // --- Definir los Roles ---
        $rolesData = [
            [
                'id' => 1, // Asignar ID explícito para referencia fácil si se necesita
                'nombreRol' => 'Administrador del Sistema',
                'descripcion' => 'Acceso total al sistema. Gestiona configuraciones, roles, permisos, supervisa todas las áreas, gestiona donaciones y crea/gestiona las cuentas de otros usuarios administrativos.',
                'permissions' => ['*'] // Lista de nombres de permisos para este rol
            ],
            [
                'id' => 2,
                'nombreRol' => 'Bibliotecario Circulación',
                'descripcion' => 'Gestiona préstamos, devoluciones, renovaciones, reservas y multas.',
                'permissions' => [
                    "circulacion:prestamo", "circulacion:devolucion", "circulacion:renovacion",
                    "circulacion:gestion_reservas", "circulacion:prestamo_especial",
                    "circulacion:prestamo_interbib_basico", "usuarios:ver_basico",
                    "usuarios:gestionar_bloqueos", "multas:registrar_pago", "multas:ver_usuario"
                ]
            ],
            [
                'id' => 3,
                'nombreRol' => 'Catalogador',
                'descripcion' => 'Gestiona el catálogo bibliográfico, registros de autoridad y registros de ítems.',
                'permissions' => [
                    "catalogo:registros_bib:crud", "catalogo:registros_bib:import_export",
                    "catalogo:autoridades:crud", "catalogo:items:crud", "catalogo:items:asignar_id",
                    "catalogo:items:gestionar_ubicacion_estado", "catalogo:inventario:participar"
                ]
            ],
            [
                'id' => 4,
                'nombreRol' => 'Gestor Contenido Formativo',
                'descripcion' => 'Gestiona el contenido del módulo formativo "Aprende en SIBIPN" y eventos asociados.',
                'permissions' => [
                    "formacion:contenido:crud", "formacion:categorias:crud", "formacion:eventos:crud",
                    "formacion:inscripciones:gestionar", "formacion:evaluaciones:crud",
                    "formacion:progreso:ver", "formacion:certificados:emitir"
                ]
            ],
            [
                'id' => 5,
                'nombreRol' => 'Moderador Comunidad',
                'descripcion' => 'Modera foros y gestiona grupos dentro de la comunidad SIBIPN.',
                'permissions' => [
                    "comunidad:moderar_posts", "comunidad:gestionar_miembros_grupo",
                    "comunidad:atender_reportes"
                ]
            ],
            [
                'id' => 6,
                'nombreRol' => 'Gestor Adquisiciones/Donaciones',
                'descripcion' => 'Gestiona el proceso de adquisición de nuevos materiales y las donaciones.',
                'permissions' => [
                    "adquisiciones:proveedores:crud", "adquisiciones:ordenes:crud",
                    "adquisiciones:presupuestos:gestionar", "adquisiciones:recepcion:registrar",
                    "donaciones:crud"
                ]
            ],
        ];

        // --- Crear Roles y Asignar Permisos ---
        foreach ($rolesData as $roleData) {
            // Crear el rol (sin la clave 'permissions')
            $role = RolAdmin::create([
                'id' => $roleData['id'], // Usar ID explícito
                'nombreRol' => $roleData['nombreRol'],
                'descripcion' => $roleData['descripcion'],
            ]);

            // Obtener los IDs de los permisos correspondientes a los nombres
            // Asegúrate que PermissionSeeder se ejecute ANTES que RolAdminSeeder
            $permissionNames = $roleData['permissions'];
            $permissionIds = Permission::whereIn('name', $permissionNames)->pluck('id');

            // Asignar los permisos al rol usando la relación (tabla pivote)
            if ($permissionIds->isNotEmpty()) {
                $role->permissions()->attach($permissionIds); // Usa el método de la relación
            }
        }

        // Mensaje en consola (opcional)
        $this->command->info('Tabla rol_admin poblada y permisos asignados a roles.');
    }
}
