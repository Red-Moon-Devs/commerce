<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Vérifiez si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect('/login'); // Redirige vers la page de connexion si non authentifié
        }

        // Vérifiez si l'utilisateur a le rôle requis
        if (Auth::user()->role !== $role) {
            return response()->view('errors.403', [], 403); // Affiche une page d'erreur 403 si l'utilisateur n'a pas accès
        }

        return $next($request);
    }
}
