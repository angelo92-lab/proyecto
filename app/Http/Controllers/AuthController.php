<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $usuario = User::where('username', $request->username)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {
            if (!$usuario->es_funcionario) {
                return back()->withErrors(['mensaje' => 'Acceso denegado. Solo funcionarios autorizados.']);
            }

            // Autenticar usuario con Laravel Auth
            Auth::login($usuario);

            // Redirigir al portal de funcionarios
            return redirect()->route('portal.funcionarios');
        }

        return back()->withErrors(['mensaje' => 'Usuario o contraseña incorrectos']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
