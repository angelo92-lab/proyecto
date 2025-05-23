<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificarFuncionario
{
    /**
     * Maneja la petición entrante.
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Debes iniciar sesión.');
        }

        // Verifica que el usuario sea funcionario
        if (!Auth::user()->es_funcionario) {
            abort(403, 'Acceso no autorizado. Solo funcionarios pueden acceder.');
        }

        return $next($request);
    }
}
