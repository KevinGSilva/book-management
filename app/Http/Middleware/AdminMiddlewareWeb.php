<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddlewareWeb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('web')->check() || !auth('web')->user()->is_admin == 1) {
            auth('web')->logout(); // Força o logout
            
            return redirect()->route('login');
        }

        return $next($request);
    }
}
