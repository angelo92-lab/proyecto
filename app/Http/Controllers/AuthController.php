<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'username' => 'required',
            'password' => 'required',
        ]);

        $usuario = DB::table('usuarios')->where('username', $request->username)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {
            // Login correcto
            session(['usuario_id' => $usuario->id, 'username' => $usuario->username, 'rol' => $usuario->rol]);
            return redirect('alumnoscasino');
        } else {
            return back()->withErrors(['mensaje' => 'Usuario o contraseña incorrectos']);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Cierra la sesión del usuario autenticado
        $request->session()->invalidate(); // Invalida la sesión
        $request->session()->regenerateToken(); // Regenera el token CSRF
    
        return redirect()->route('login'); // Redirige a la ruta de login
    }
   
}