<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Menangani permintaan masuk (incoming request) dan memvalidasi peran pengguna.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Auth::user();
        
        // Jika pengguna tidak terotentikasi atau perannya tidak sesuai
        if (!$user || $user->role !== $role) {
            // Berikan respons JSON jika permintaan mengharapkan format JSON (API)
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Akses ditolak.'], 403);
            }
            // Arahkan kembali ke halaman utama untuk rute web biasa
            return redirect('/');
        }

        return $next($request);
    }
}
