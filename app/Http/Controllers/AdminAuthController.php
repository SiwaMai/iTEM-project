<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        $data = [
            'userType' => 'ผู้ดูแลระบบ',
            'icon' => 'ad.png',
            'bgColor' => '#6c757d',
            'hoverColor' => '#5a6268'
        ];

        return view('auth.admin_login', $data);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate(); // เพื่อความปลอดภัย
            session()->flash('login_status', 'ยินดีต้อนรับเข้าสู่ระบบ');

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()
            ->withInput()
            ->with('login_error', [
                'title' => 'เข้าสู่ระบบไม่สำเร็จ',
                'text' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'
            ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index')->with('logout_success', 'คุณได้ออกจากระบบเรียบร้อยแล้ว');
    }
}
