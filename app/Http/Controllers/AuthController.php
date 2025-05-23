<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Buscar usuario por username
        $usuario = User::where('username', $request->username)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {
            if (!$usuario->es_funcionario) {
                return back()->withErrors(['mensaje' => 'Acceso denegado. Solo funcionarios autorizados.']);
            }

            // ✅ Iniciar sesión correctamente
            Auth::login($usuario);

            // Redirigir al portal de funcionarios
            return redirect()->route('portal.funcionarios');
        }

        return back()->withErrors(['mensaje' => 'Usuario o contraseña incorrectos']);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Cierra la sesión del usuario autenticado
        $request->session()->invalidate(); // Invalida la sesión
        $request->session()->regenerateToken(); // Regenera el token CSRF

        return redirect()->route('login'); // Redirige a la ruta de login
    }
}
