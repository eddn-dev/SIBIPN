<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correoInstitucional' => 'required|email',
            'password'            => 'required|string',
        ]);

        if (Auth::attempt([
                'correoInstitucional' => $credentials['correoInstitucional'],
                'password'            => $credentials['password'],
                'estadoUsuario'       => 'Activo'
            ], $request->filled('remember'))
        ) {
            // 1) Regenera la sesión para evitar fijación
            $request->session()->regenerate();
            
            // 2) Regenera también el token CSRF
            $request->session()->regenerateToken();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'correoInstitucional' => 'Credenciales inválidas o cuenta no activa.',
        ]);
    }

}
