<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user || !$user->roles()->whereIn('role', $roles)->exists()) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return $next($request);
    }
}
