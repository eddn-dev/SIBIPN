<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard principal del panel de administración.
     * Por ahora, solo retorna la vista sin datos específicos.
     */
    public function index(): View
    {
        // Más adelante, aquí puedes cargar datos como:
        // $totalUsuarios = Usuario::count();
        // $pendientesVerificacion = Usuario::whereNull('email_verified_at')->count();
        // $rolesCount = RolAdmin::count();
        // ...etc.

        // Y pasarlos a la vista:
        // return view('admin.dashboard', compact('totalUsuarios', 'pendientesVerificacion', 'rolesCount'));

        return view('admin.dashboard'); // Retorna la vista placeholder
    }
}
