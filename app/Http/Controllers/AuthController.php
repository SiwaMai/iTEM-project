<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    // แสดงหน้าล็อกอินตามประเภทผู้ใช้ (นักศึกษา/บุคลากร)
    public function showLogin(Request $request, $userType = 'student')
    {
        $userData = [
            'student' => [
                'userType' => 'นักศึกษา',
                'icon' => 'students.png',
                'bgColor' => '#28a745',
                'hoverColor' => '#218838'
            ],
            'staff' => [
                'userType' => 'บุคลากร',
                'icon' => 'team.png',
                'bgColor' => '#007bff',
                'hoverColor' => '#0056b3'
            ],
        ];

        $data = $userData[$userType] ?? $userData['student'];

        return view('auth.login_template', $data);
    }

    // ล็อกอินสำหรับนักศึกษาและบุคลากร
    public function login(Request $request, $userType = 'student')
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();
            Auth::login($user);

            if (Auth::check()) {
                $position = $user->position;

                if (in_array($position, ['staff', 'teacher', 'student'])) {
                    session()->flash('login_status', 'ยินดีต้อนรับเข้าสู่ระบบ');
                    return redirect()->route('dashboard');
                }
            }

            return back()->withErrors(['username' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง']);
        }

        return back()->withErrors(['username' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง']);
    }

    // แสดงฟอร์มรีเซ็ตรหัสผ่าน
    public function showResetForm()
    {
        return view('auth.reset_password');
    }

    // รีเซ็ตรหัสผ่าน
    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $typeMap = [
            'นักศึกษา' => 'student',
            'อาจารย์' => 'teacher',
            'บุคลากร' => 'staff',
        ];

        $typeKey = $typeMap[$request->userType] ?? 'student';

        $user = User::where('username', $request->username)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('index')->with('status', 'เปลี่ยนรหัสผ่านสำเร็จ');
        } else {
            return back()->withErrors(['username' => 'ไม่พบผู้ใช้งานนี้']);
        }
    }

    // ล็อกเอาท์ผู้ใช้ระบบหลัก
    public function logout()
    {
        Auth::logout();
        return redirect()->route('index')->with('logout_success', 'คุณได้ออกจากระบบเรียบร้อยแล้ว');
    }

    /*
    // แสดงหน้าล็อกอินสำหรับบุคคลภายนอก
    public function showExternalLogin()
    {
        return view('auth.external_login');
    }

    // ล็อกอินบุคคลภายนอก
    public function loginExternal(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'phone' => 'required|string',
        ]);

        Session::put('external_user', [
            'name'  => $request->name,
            'phone' => $request->phone
        ]);

        session()->flash('login_status', 'เข้าสู่ระบบเรียบร้อยแล้ว');
        return redirect()->route('dashboard'); // ✅ ใช้ dashboard เดียวกับนักศึกษา
    }

    // ล็อกเอาท์บุคคลภายนอก
    public function logoutExternal()
    {
        Session::forget('external_user');
        return redirect()->route('external.login')->with('logout_success', 'คุณได้ออกจากระบบเรียบร้อยแล้ว');
    }
        */
}