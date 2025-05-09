<?php

namespace App\Providers;

// Importaciones necesarias
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Usuario; // Asegúrate que la ruta a tu modelo User/Usuario sea correcta

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy', // Registra tus Policies aquí si las usas
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies(); // Registra las policies definidas arriba

        /**
         * Gate::before se ejecuta antes que cualquier otro Gate o Policy.
         * Si retorna true, la autorización se concede inmediatamente.
         * Aquí lo usamos para dar acceso total al Super Administrador.
         * Asumimos que el método isAdmin() en el modelo Usuario identifica a este super admin
         * (podría ser por ID, por un rol específico, o por tener el permiso '*').
         */
        Gate::before(function (Usuario $usuario, $ability) {
            // El método hasPermissionTo debería manejar internamente el permiso '*'
            if ($usuario->isSuperAdmin()) {
                 return true;
            }
            // Alternativamente, si tienes un método específico para Super Admin:
            // if ($usuario->isSuperAdmin()) { // O como identifiques al super admin
            //     return true;
            // }
            return null; // Importante retornar null para que continúe la evaluación de otros Gates/Policies
        });

        /**
         * Gate general para verificar si un usuario tiene *algún* rol administrativo
         * asignado, útil para proteger el acceso básico al panel de administración.
         * Asumimos que hasAdminRole() verifica si idRolAdmin no es null.
         */
        Gate::define('acceder-panel-admin', function (Usuario $usuario) {
            return $usuario->hasAdminRole(); // O !is_null($usuario->idRolAdmin)
        });

        // --- Definición de Gates Específicos por Permiso ---
        // Cada Gate utiliza el método hasPermissionTo del modelo Usuario,
        // que debe verificar si el rol asignado al usuario tiene el permiso específico.

        // --- Grupo: Usuarios y Roles (GES-USR) ---
        Gate::define('gestionar-usuarios', fn(Usuario $u) => $u->hasPermissionTo('usuarios:crud'));
        Gate::define('ver-usuarios-basico', fn(Usuario $u) => $u->hasPermissionTo('usuarios:ver_basico'));
        Gate::define('asignar-roles-usuarios', fn(Usuario $u) => $u->hasPermissionTo('usuarios:asignar_rol'));
        Gate::define('crear-usuarios', fn(Usuario $u) => $u->hasPermissionTo('usuarios:crear'));
        Gate::define('eliminar-usuarios', fn(Usuario $u) => $u->hasPermissionTo('usuarios:eliminar'));
        Gate::define('gestionar-bloqueos-usuarios', fn(Usuario $u) => $u->hasPermissionTo('usuarios:gestionar_bloqueos'));
        Gate::define('gestionar-roles', fn(Usuario $u) => $u->hasPermissionTo('roles:crud'));

        // --- Grupo: Catálogo (GES-CAT, GES-ITE) ---
        Gate::define('gestionar-registros-bib', fn(Usuario $u) => $u->hasPermissionTo('catalogo:registros_bib:crud'));
        Gate::define('importar-exportar-registros-bib', fn(Usuario $u) => $u->hasPermissionTo('catalogo:registros_bib:import_export'));
        Gate::define('gestionar-autoridades', fn(Usuario $u) => $u->hasPermissionTo('catalogo:autoridades:crud'));
        Gate::define('gestionar-items', fn(Usuario $u) => $u->hasPermissionTo('catalogo:items:crud'));
        Gate::define('asignar-id-item', fn(Usuario $u) => $u->hasPermissionTo('catalogo:items:asignar_id'));
        Gate::define('gestionar-ubicacion-estado-item', fn(Usuario $u) => $u->hasPermissionTo('catalogo:items:gestionar_ubicacion_estado'));
        Gate::define('participar-inventario', fn(Usuario $u) => $u->hasPermissionTo('catalogo:inventario:participar'));

        // --- Grupo: Circulación (GES-CIR) ---
        Gate::define('realizar-prestamo', fn(Usuario $u) => $u->hasPermissionTo('circulacion:prestamo'));
        Gate::define('registrar-devolucion', fn(Usuario $u) => $u->hasPermissionTo('circulacion:devolucion'));
        Gate::define('realizar-renovacion', fn(Usuario $u) => $u->hasPermissionTo('circulacion:renovacion'));
        Gate::define('gestionar-reservas', fn(Usuario $u) => $u->hasPermissionTo('circulacion:gestion_reservas'));
        Gate::define('registrar-prestamo-especial', fn(Usuario $u) => $u->hasPermissionTo('circulacion:prestamo_especial'));
        Gate::define('gestionar-prestamo-interbib', fn(Usuario $u) => $u->hasPermissionTo('circulacion:prestamo_interbib_basico'));

        // --- Grupo: Multas (GES-FIN) ---
        Gate::define('registrar-pago-multa', fn(Usuario $u) => $u->hasPermissionTo('multas:registrar_pago'));
        Gate::define('ver-multas-usuario', fn(Usuario $u) => $u->hasPermissionTo('multas:ver_usuario'));
        Gate::define('condonar-multa', fn(Usuario $u) => $u->hasPermissionTo('multas:condonar'));
        Gate::define('registrar-multa-manual', fn(Usuario $u) => $u->hasPermissionTo('multas:registrar_manual'));

        // --- Grupo: Adquisiciones y Donaciones (GES-ADQ, GES-DON) ---
        Gate::define('gestionar-proveedores', fn(Usuario $u) => $u->hasPermissionTo('adquisiciones:proveedores:crud'));
        Gate::define('gestionar-ordenes-compra', fn(Usuario $u) => $u->hasPermissionTo('adquisiciones:ordenes:crud'));
        Gate::define('gestionar-presupuestos', fn(Usuario $u) => $u->hasPermissionTo('adquisiciones:presupuestos:gestionar'));
        Gate::define('registrar-recepcion-adq', fn(Usuario $u) => $u->hasPermissionTo('adquisiciones:recepcion:registrar'));
        Gate::define('gestionar-donaciones', fn(Usuario $u) => $u->hasPermissionTo('donaciones:crud'));

        // --- Grupo: Formación (FOR-GCO) ---
        Gate::define('gestionar-contenido-formativo', fn(Usuario $u) => $u->hasPermissionTo('formacion:contenido:crud'));
        Gate::define('gestionar-categorias-formativas', fn(Usuario $u) => $u->hasPermissionTo('formacion:categorias:crud'));
        Gate::define('gestionar-eventos-formativos', fn(Usuario $u) => $u->hasPermissionTo('formacion:eventos:crud'));
        Gate::define('gestionar-inscripciones-formacion', fn(Usuario $u) => $u->hasPermissionTo('formacion:inscripciones:gestionar'));
        Gate::define('gestionar-evaluaciones-formacion', fn(Usuario $u) => $u->hasPermissionTo('formacion:evaluaciones:crud'));
        Gate::define('ver-progreso-formacion', fn(Usuario $u) => $u->hasPermissionTo('formacion:progreso:ver'));
        Gate::define('emitir-certificados-formacion', fn(Usuario $u) => $u->hasPermissionTo('formacion:certificados:emitir'));

        // --- Grupo: Comunidad (COM-GFG) ---
        Gate::define('gestionar-foros', fn(Usuario $u) => $u->hasPermissionTo('comunidad:gestionar_foros'));
        Gate::define('moderar-posts-comunidad', fn(Usuario $u) => $u->hasPermissionTo('comunidad:moderar_posts'));
        Gate::define('gestionar-grupos-comunidad', fn(Usuario $u) => $u->hasPermissionTo('comunidad:gestionar_grupos'));
        Gate::define('gestionar-miembros-grupo-comunidad', fn(Usuario $u) => $u->hasPermissionTo('comunidad:gestionar_miembros_grupo'));
        Gate::define('atender-reportes-comunidad', fn(Usuario $u) => $u->hasPermissionTo('comunidad:atender_reportes'));

        // --- Grupo: Configuración (GES-CFG) ---
        // Gate general para acceder a cualquier sección de configuración (si se necesita)
        Gate::define('gestionar-configuracion-general', fn(Usuario $u) => $u->hasPermissionTo('config:gestionar-configuracion'));
        // Gates específicos
        Gate::define('gestionar-bibliotecas', fn(Usuario $u) => $u->hasPermissionTo('config:bibliotecas:crud'));
        Gate::define('gestionar-politicas-circulacion', fn(Usuario $u) => $u->hasPermissionTo('config:politicas:crud'));
        Gate::define('gestionar-ubicaciones', fn(Usuario $u) => $u->hasPermissionTo('config:ubicaciones:crud'));
        Gate::define('gestionar-parametros', fn(Usuario $u) => $u->hasPermissionTo('config:parametros:gestionar'));

        // --- Grupo: Reportes (GES-REP) ---
        Gate::define('ver-reportes', fn(Usuario $u) => $u->hasPermissionTo('reportes:ver'));

    }
}
