<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckCountry
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user(); 
        // Permitir al administrador acceder a todos los registros 
        if ($user->hasRole('Administrator')) { 
            return $next($request); 
        } 
        
        // Verificar el país del usuario 
        $country = $request->route('country'); 
        if ($user->country !== $country) { 
            return response()->json(['error' => 'Unauthorized.'], 403); 
        } 
        
        return $next($request);
    }
}
