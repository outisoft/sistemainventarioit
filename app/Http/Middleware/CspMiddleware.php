<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Contracts\Foundation\Application;

class CspMiddleware
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        // Solo aplicar CSP en producción
        if (!$this->app->environment('production')) {
            return $response;
        }

        $nonce = Str::random(32);
        $request->attributes->set('csp_nonce', $nonce);

        $csp = [
            "default-src 'self'",
            "script-src 'self' 'nonce-{$nonce}' 
            https://code.jquery.com 
            https://cdn.jsdelivr.net 
            https://cdn.datatables.net 
            https://unpkg.com 
            https://*.livewire.com;",
            "style-src 'self' 'unsafe-inline' https://cdn.datatables.net https://cdnjs.cloudflare.com",
            "img-src 'self' data: https://cdn.datatables.net https://buttons.github.io",
            "font-src 'self' data:",
            "connect-src 'self'",
            "frame-src 'self' https://buttons.github.io",
            "object-src 'none'",
            "base-uri 'self'"
        ];

        $response->headers->set('Content-Security-Policy', implode('; ', $csp));
        
        return $response;
    }
}