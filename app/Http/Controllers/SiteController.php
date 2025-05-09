<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index(Request $request): View
    {
        $usuario = Auth::user(); // Obtiene el usuario autenticado

        // Pasar los datos a la vista
        return view('sibipn', [
        ]);
    }
}
