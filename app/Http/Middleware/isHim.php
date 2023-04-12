<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isHim
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $id = $request->route('id');
        if ($user->id == $id || $user->hasAnyRole('administrateur')) {
            return $next($request);
        }
        return response()->json(['error' => 'Forbidden' ], 403);

    }
}
