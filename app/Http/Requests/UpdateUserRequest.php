<?php

namespace App\Http\Requests; // Asegúrate que el namespace sea correcto

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Usuario; // Importa tu modelo Usuario
use App\Models\RolAdmin; // Importa RolAdmin si validas contra él
use Illuminate\Support\Facades\Auth; // Para verificar el usuario autenticado
use Illuminate\Validation\Rules\Password; // Importar Password Rule

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Asegúrate que el usuario autenticado tenga permiso para actualizar usuarios
        // Puedes usar Gate::allows o $this->user()->can()
        return $this->user()->can('gestionar-usuarios');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $userToUpdate = $this->route('user'); // Obtener el usuario desde la ruta (Route Model Binding)
        if (!$userToUpdate) {
            // Manejar el caso donde el usuario no se encuentra, aunque con Route Model Binding es raro
             return [];
        }
        $isStaff = $userToUpdate->categoriaUsuario === 'Administrativo'; // Asumiendo 'Administrativo' es la categoría staff

        $rules = [];

        // Reglas para usuarios Staff (Administrativo)
        if ($isStaff) {
            $rules['idRolAdmin'] = [
                'nullable', // Puede ser nulo para quitar el rol
                'integer', // Debe ser un entero
                Rule::exists('rol_admin', 'id') // Debe existir en la tabla rol_admin
            ];
            // La contraseña es opcional al actualizar
            $rules['new_password'] = [
                'nullable', // <<-- CAMBIO CLAVE: Permite que el campo esté vacío o no se envíe
                'string',
                Password::min(8) // O la longitud mínima que prefieras si se envía
                                  // Puedes añadir más reglas de complejidad aquí si es necesario
                                  // ->mixedCase()->numbers()->symbols() ...
                // 'confirmed' // Añadir si implementas campo de confirmación en la vista
            ];
        }
        // Reglas para usuarios Públicos (No Staff)
        else {
            // Lógica para determinar los estados posibles para usuarios públicos
             $possibleStates = [];
             if ($userToUpdate->estadoUsuario === 'PendienteConfirmacion') {
                 $possibleStates = ['PendienteConfirmacion', 'Activo']; // Solo puede pasar a Activo
             } elseif ($userToUpdate->email_verified_at) {
                 $possibleStates = ['Activo', 'Inactivo', 'Suspendido']; // Estados para verificados
             } else {
                 // Si no está verificado y no está pendiente, teóricamente no debería poder cambiarse
                 // Pero mantenemos el estado actual como opción válida por si acaso
                 $possibleStates = [$userToUpdate->estadoUsuario];
             }
              // Asegurarse que el estado actual siempre esté en la lista por si acaso
             if (!in_array($userToUpdate->estadoUsuario, $possibleStates)) {
                array_unshift($possibleStates, $userToUpdate->estadoUsuario);
            }


            $rules['estadoUsuario'] = [
                'required',
                'string',
                Rule::in($possibleStates) // Debe ser uno de los estados permitidos
            ];
            // Los usuarios públicos no deberían tener contraseña modificable aquí
            // ni rol administrativo.
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'idRolAdmin.exists' => 'El rol seleccionado no es válido.',
            'new_password.min' => 'Si se proporciona una nueva contraseña, debe tener al menos :min caracteres.',
            'estadoUsuario.in' => 'El estado seleccionado no es válido para este usuario.',
        ];
    }

     /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        // Asegurarse que idRolAdmin sea null si está vacío (para Staff)
        if ($this->isStaff() && $this->filled('idRolAdmin') && $this->input('idRolAdmin') === '') {
            $this->merge([
                'idRolAdmin' => null,
            ]);
        }

        // Si new_password está presente pero vacío, convertirlo a null
        // para que la regla 'nullable' funcione correctamente y no aplique 'min:8'.
        if ($this->has('new_password') && $this->input('new_password') === '') {
             $this->merge([
                'new_password' => null,
            ]);
        }
    }

    /**
     * Helper para verificar si el usuario a actualizar es Staff.
     *
     * @return bool
     */
    protected function isStaff(): bool
    {
        $userToUpdate = $this->route('user');
        return $userToUpdate && $userToUpdate->categoriaUsuario === 'Administrativo';
    }
}