<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            // Store intended URL for redirect after login
            if (!$request->is('admin/login')) {
                session()->put('url.intended', $request->url());
            }
            
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}