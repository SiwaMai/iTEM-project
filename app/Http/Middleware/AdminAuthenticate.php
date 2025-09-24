<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('AdminAuthenticate middleware called.');

        if (!Auth::check() || Auth::user()->role !== 'admin') {
            Log::error('Unauthorized access attempt.');
            return redirect()->route('admin.login')->withErrors(['access' => 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้']);
        }

        return $next($request);
    }
    
}