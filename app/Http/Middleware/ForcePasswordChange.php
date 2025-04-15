<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        // Si el usuario no es admin y debe cambiar la contraseña
        if ($user && !$user->hasRole('Administrat') && ($user->first_login || $user->force_password_change)) {
            if (!$request->is('password/change*') && !$request->is('logout')) {
                return redirect()->route('password.change');
            }
        }
        
        return $next($request);
    }
}
