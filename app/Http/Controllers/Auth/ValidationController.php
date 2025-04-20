<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Tu modelo de usuario
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidationController extends Controller
{
    /**
     * Verifica si un valor de campo ya existe para un usuario.
     */
    public function checkField(Request $request): JsonResponse
    {
        // Validar la entrada
        $validator = Validator::make($request->all(), [
            'field' => ['required', 'string', 'in:boleta,email'], // Campos permitidos
            'value' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Datos inválidos.'], 422);
        }

        $field = $request->input('field');
        $value = $request->input('value');

        // Realizar la consulta
        $exists = Usuario::where($field, $value)->exists();

        // Devolver respuesta JSON
        return response()->json(['exists' => $exists]);
    }
}
