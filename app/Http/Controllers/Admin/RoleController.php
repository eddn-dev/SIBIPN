<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RolAdmin;
use App\Models\Permission; // Importar Permission
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB; // DB sigue siendo útil para transacciones si se necesita
use Illuminate\Validation\Rule;
// Quitamos ValidationException ya que no la usamos directamente aquí ahora

class RoleController extends Controller
{
    /**
     * Nombre exacto del rol de super administrador que no debe ser modificado.
     * @var string
     */
    protected $systemAdminRoleName = 'Administrador del Sistema';

    /**
     * Muestra una lista de los roles administrativos.
     */
    public function index(): View
    {
        Gate::authorize('gestionar-roles');
        // Cargar la cuenta de usuarios asociados a cada rol eficientemente
        $roles = RolAdmin::withCount('usuarios')->orderBy('nombreRol')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Muestra el formulario para editar los permisos de un rol específico.
     *
     * @param RolAdmin $role // Usa Route Model Binding
     * @return View
     */
    public function edit(RolAdmin $role): View
    {
        Gate::authorize('gestionar-roles');

        $isSystemAdmin = ($role->nombreRol === $this->systemAdminRoleName);
        $availablePermissionsGrouped = collect(); // Inicializar como colección vacía
        $assignedPermissionIds = []; // IDs de permisos actualmente asignados al rol

        // Solo obtenemos permisos si NO es el admin del sistema
        if (!$isSystemAdmin) {
            // Obtener todos los permisos disponibles (excluyendo '*') agrupados por 'group'
            $availablePermissionsGrouped = Permission::orderBy('group')->orderBy('name')
                ->where('name', '!=', '*') // Excluir el permiso global '*'
                ->get()
                ->groupBy('group'); // Agrupar para la vista

            // Obtener los IDs de los permisos que este rol ya tiene asignados
            // Usamos la relación definida en el modelo RolAdmin
            $assignedPermissionIds = $role->permissions()->pluck('permissions.id')->toArray();
        }
        // Para el admin, $availablePermissionsGrouped se quedará vacío y $assignedPermissionIds también.

        return view('admin.roles.edit', compact(
            'role',
            'availablePermissionsGrouped', // Permisos disponibles agrupados
            'assignedPermissionIds',       // IDs de permisos asignados
            'isSystemAdmin'                // Flag para la vista
        ));
    }

    /**
     * Actualiza los permisos para un rol específico usando la tabla pivote.
     * Previene la modificación del rol Administrador del Sistema.
     *
     * @param Request $request
     * @param RolAdmin $role // Usa Route Model Binding
     * @return RedirectResponse
     */
    public function update(Request $request, RolAdmin $role): RedirectResponse
    {
        Gate::authorize('gestionar-roles');

        // --- Guarda: Prevenir modificación del rol Admin del Sistema ---
        if ($role->nombreRol === $this->systemAdminRoleName) {
            return redirect()->route('admin.roles.index')
                             ->with('warning', 'Los permisos del rol Administrador del Sistema no se pueden modificar.');
        }
        // --- Fin Guarda ---

        // Obtener todos los IDs de permisos válidos (excluyendo el permiso '*')
        $validPermissionIds = Permission::where('name', '!=', '*')->pluck('id')->toArray();

        // Validar la entrada 'permission_ids' (esperamos un array de IDs)
        $validated = $request->validate([
            // 'permission_ids' debe ser un array (puede ser vacío si no se selecciona ninguno)
            'permission_ids' => ['nullable', 'array'],
            // Cada ID en el array debe existir en la tabla 'permissions' y no ser el ID de '*'
            'permission_ids.*' => ['integer', Rule::in($validPermissionIds)],
        ]);

        // Obtener el array de IDs de permisos validados (o un array vacío)
        $permissionIdsToAssign = $validated['permission_ids'] ?? [];

        // Sincronizar los permisos en la tabla pivote.
        // sync() se encarga de:
        // 1. Añadir los nuevos IDs que no estaban.
        // 2. Mantener los IDs que ya estaban y están en la nueva lista.
        // 3. Eliminar los IDs que estaban antes pero no están en la nueva lista.
        try {
            $role->permissions()->sync($permissionIdsToAssign);
        } catch (\Exception $e) {
            // Manejar posible error de base de datos
            return redirect()->back()
                             ->with('error', 'Ocurrió un error al actualizar los permisos: ' . $e->getMessage())
                             ->withInput(); // Mantener los datos del formulario
        }


        return redirect()->route('admin.roles.index')->with('success', "Permisos para el rol '{$role->nombreRol}' actualizados correctamente.");
    }
}
