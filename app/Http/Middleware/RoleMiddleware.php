<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // Vérifier si l'utilisateur a au moins l'un des rôles requis
        $hasRole = false;
        foreach ($roles as $role) {
            if ($user->hasAnyRole($role)) {
                $hasRole = true;
                break;
            }
        }

        // Si l'utilisateur n'a aucun des rôles requis, retourner une réponse d'erreur
        if (!$hasRole) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
