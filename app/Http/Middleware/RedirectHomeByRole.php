<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectHomeByRole
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        if (Auth::user()->role === 'penjual') {
            return redirect()->route('penjual.dashboard');
        }

        return $next($request);
    }
}
