<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verificar si el usuario está autenticado
        if (!$request->user()) {
            return redirect('/')->with('errors', 'Debe estar autenticado para acceder.');
        }

        // Verificar si el usuario tiene uno de los roles requeridos
        foreach ($roles as $role) {
            if ($request->user()->has_rol($role)) {
                return $next($request);
            }
        }

        return redirect('/')->with('errors', 'No tiene los permisos para acceder.');
    }
}
