<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate; // <-- Importar Gate
use Symfony\Component\HttpFoundation\Response;
// No necesitas importar Usuario aquí si solo usas Auth::user() y Gate

class CheckAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verifica si hay un usuario autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Obtiene el usuario autenticado (Gate lo recibirá implícitamente)
        // $user = Auth::user(); // No es estrictamente necesario aquí si usas Gate

        // 3. *** CORRECCIÓN: Usa el Gate 'acceder-panel-admin' ***
        // Este Gate verifica si el usuario tiene CUALQUIER rol admin asignado
        // usando el método hasAdminRole() (que también corregiremos)
        if (Gate::allows('acceder-panel-admin')) {
            // 4. Si tiene permiso general, permite que la solicitud continúe
            return $next($request);
        }

        // 5. Si no tiene permiso general, aborta
        abort(403, 'Acceso no autorizado. Se requiere un rol administrativo.');
    }
}