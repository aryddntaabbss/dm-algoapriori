<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Kalau belum login
        if (!$user) {
            return redirect('/login');
        }

        // Cek role user
        if (!in_array($user->role, $roles)) {
            // Redirect kalau role tidak sesuai
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'pengunjung') {
                return redirect()->route('dashboard');
            } else {
                Auth::logout();
                return redirect('/login')->withErrors([
                    'email' => 'Role tidak dikenali.',
                ]);
            }
        }

        return $next($request);
    }
}
