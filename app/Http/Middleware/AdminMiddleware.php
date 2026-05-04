<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah user sudah login DAN role-nya adalah 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, tendang ke halaman depan
        return redirect('/')->with('error', 'Akses ditolak!');
    }
}