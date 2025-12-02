<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if ($role === 'admin' && Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak! Hanya Admin.');
        }

        return $next($request);
    }
}