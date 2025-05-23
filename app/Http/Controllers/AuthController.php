<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Busca el usuario por username
        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            return back()->withErrors(['mensaje' => 'Usuario no encontrado.']);
        }

        if (!$user->es_funcionario) {
            return back()->withErrors(['mensaje' => 'Acceso denegado. Solo funcionarios autorizados.']);
        }

        // Intenta loguear con las credenciales
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            // Redirige a la ruta que quieras para funcionarios
            return redirect()->intended('/portal-funcionarios');
        }

        return back()->withErrors(['mensaje' => 'Credenciales incorrectas.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
