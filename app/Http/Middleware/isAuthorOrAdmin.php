<?php

namespace App\Http\Middleware;

use App\Models\Commentaire;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAuthorOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        //Un visiteur connecté (role adhérent) qui est l’auteur du commentaire ou un utilisateur ayant le rôle commentaire-moderateur ou administrateur
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Vérifier si l'utilisateur a au moins l'un des rôles requis
        $hasRole = false;
        foreach ($roles as $role) {
            if ($user->hasAnyRole($role) || Commentaire::findOrFail($request->route('id'))->user_id == Auth::user()->id) {
                $hasRole = true;
                break;
            }


        }
        if (!$hasRole) {
            return response()->json(['error' => 'Forbidden you doesnt have the permission',Auth::user()->id], 403);
        }

        return $next($request);
    }

}
