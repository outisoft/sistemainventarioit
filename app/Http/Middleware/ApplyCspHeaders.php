<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Csp\Nonce\NonceGenerator;
use Spatie\Csp\Nonce\AppNonceGenerator;

class ApplyCspHeaders
{
    public function handle($request, Closure $next)
    {
        $nonce = app(NonceGenerator::class)->generate();
        
        config()->set('csp.nonce', $nonce);
        
        $response = $next($request);
        
        $response->headers->set(
            'Content-Security-Policy',
            "script-src 'self' 'wasm-unsafe-eval' 'nonce-{$nonce}'"
        );
        
        return $response;
    }
}