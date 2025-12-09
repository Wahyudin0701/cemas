<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user login
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // 2. Konversi parameter $roles dari string ke Enum
        $allowedRoles = array_map(
            fn($role) => UserRole::from($role),
            $roles
        );

        // 3. Validasi apakah role user termasuk di daftar yang diijinkan
        if (in_array($user->role, $allowedRoles, strict: true)) {
            return $next($request);
        }

        // 4. Jika tidak sesuai → Forbidden
        abort(403, 'Akses tidak diizinkan.');
    }
}
