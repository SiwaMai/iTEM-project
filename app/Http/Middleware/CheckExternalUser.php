<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckExternalUser
{
    public function handle($request, Closure $next)
    {
        // ตรวจสอบ session สำหรับบุคคลภายนอก
        if (!Session::has('external_user')) {
            // ส่งกลับไปหน้า login พร้อม flash message
            Session::flash('login_required', 'กรุณาเข้าสู่ระบบก่อนใช้งาน');
            return redirect()->route('external.login');
        }

        return $next($request);
    }
}