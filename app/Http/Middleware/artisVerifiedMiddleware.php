<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class artisVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && auth()->user()->role_id === 1) {
            // Cache::put('status_persetujuan_' . auth()->user()->id, 'belum_disetujui', now()->addHours(24));
            return $next($request);
        }
        return response()->redirectTo('/masuk')->with('message', 'Anda Tidak Mendapatkan Akses Untuk Halaman Ini.');
    }
}
