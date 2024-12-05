<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleFromSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Mengambil role dari session
        $userRole = session('role');

        // Memeriksa apakah role yang ada di session sesuai dengan role yang diminta
        if ($userRole !== $role) {
            // Jika role tidak sesuai, arahkan ke halaman lain atau tampilkan error
            return redirect('/login');  // Bisa juga mengarahkan ke halaman error atau not authorized
        }

        // Lanjutkan ke request berikutnya jika role cocok
        return $next($request);
    }
}
