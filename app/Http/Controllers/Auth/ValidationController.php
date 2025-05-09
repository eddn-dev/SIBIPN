<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;

class ValidationController extends Controller
{
    public function checkField(Request $request) // O checkPublicField si usas Opción A
    {
        $validatedData = $request->validate([
            'field' => ['required', 'string', 'in:boleta,email'],
            'value' => ['required', 'string'],
            'context' => ['sometimes', 'string', 'in:admin,public'] // Para Opción B
        ]);

        $field = $validatedData['field'];
        $value = $validatedData['value'];
        $context = $validatedData['context'] ?? 'public'; // Default a public si no viene
        $exists = false;
        $errorMessage = '';
        $isValidFormat = true;

        if ($field === 'boleta') {
            if (!preg_match('/^\d{10}$/', $value)) {
                $isValidFormat = false;
                $errorMessage = 'Formato inválido (10 dígitos).';
            } else {
                $exists = Usuario::where('boleta', $value)->exists();
            }
        } elseif ($field === 'email') {
            $emailLower = strtolower($value);
            $isIpnMx = str_ends_with($emailLower, '@ipn.mx');
            $isAlumnoIpnMx = str_ends_with($emailLower, '@alumno.ipn.mx');

            // Determinar dominio válido según contexto (Opción B)
            $isValidDomain = false;
            if ($context === 'admin') {
                $isValidDomain = $isIpnMx;
                $domainErrorMessage = 'El correo debe ser @ipn.mx.';
            } else { // context === 'public'
                $isValidDomain = $isIpnMx || $isAlumnoIpnMx;
                $domainErrorMessage = 'El correo debe ser @ipn.mx o @alumno.ipn.mx válido.';
            }

            if (!filter_var($value, FILTER_VALIDATE_EMAIL) || !$isValidDomain) {
                 $isValidFormat = false;
                 $errorMessage = $domainErrorMessage;
            } else {
                $exists = Usuario::where('email', $value)->exists();
            }
        }

        // Si el formato no es válido, retorna error 422
        if (!$isValidFormat) {
             return response()->json(['exists' => null, 'message' => $errorMessage], 422);
        }

        // Si el formato es válido, retorna si existe o no
        return response()->json(['exists' => $exists]);
    }

    // Si usas Opción A, crea un método checkAdminField similar pero solo con la lógica de admin
    // public function checkAdminField(Request $request) { ... }
}