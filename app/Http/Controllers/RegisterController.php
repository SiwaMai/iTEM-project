<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // ฟังก์ชั่นแสดงฟอร์มการสมัครสมาชิก
    public function registerForm(Request $request)
{
    // สมมุติว่าเราจะตรวจสอบค่าที่มาจาก $request เพื่อกำหนด userType
    // หรือถ้าไม่สามารถกำหนดได้ก็ให้เป็นค่า default 'student'
    
    $userType = 'student'; // ค่า default

    // เงื่อนไขการตั้งค่า userType ตามบางกรณี
    if ($request->has('user_type') && $request->user_type == 'staff') {
        $userType = 'staff';  // กรณีเป็นอาจารย์
    } elseif ($request->has('user_type') && $request->user_type == 'admin') {
        $userType = 'admin';  // กรณีเป็นผู้ดูแลระบบ
    }

    // ส่งค่าตัวแปร userType ไปยัง view
    return view('register', ['userType' => $userType]);
}

    // ฟังก์ชั่นสำหรับสมัครสมาชิก
    public function register(Request $request)
{
    // ควบคุมการตรวจสอบข้อมูล
    $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:10',
        'position' => 'required|string',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'username' => 'required|string|unique:users,username',
        'password' => 'required|string|confirmed|min:8',
    ]);

    // สร้างผู้ใช้ใหม่
    $user = User::create([
        'name' => $request->name,
        'surname' => $request->surname,
        'email' => $request->email,
        'phone' => $request->phone,
        'position' => $request->position,
        'profile_image' => $request->profile_image,
        'username' => $request->username,
        'password' => bcrypt($request->password),
    ]);

    // ตรวจสอบว่าอัปโหลดรูปภาพไหม
    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension(); // ตั้งชื่อไฟล์รูปภาพ
        $image->storeAs('profile_images', $imageName, 'public'); // อัปโหลดไปที่โฟลเดอร์ profile_images
        $user->profile_image = 'profile_images/' . $imageName; // เก็บเส้นทางของไฟล์ในฐานข้อมูล
        $user->save();
    }

    // ส่ง message ให้กับ session
    session()->flash('register_success', 'ลงทะเบียนสำเร็จ! กรุณาเข้าสู่ระบบ');
    session()->flash('sweetalert', true);

    // ตรวจสอบตำแหน่งของผู้ใช้แล้วเปลี่ยนเส้นทาง
    if ($user->position == 'student') {
        return redirect()->route('login.student');  // เส้นทางสำหรับนักศึกษา
    } elseif ($user->position == 'staff') {
        return redirect()->route('login.staff');  // เส้นทางสำหรับอาจารย์
    } elseif ($user->position == 'admin') {
        return redirect()->route('login.admin');  // เส้นทางสำหรับผู้ดูแลระบบ
    }

    // ถ้าตำแหน่งไม่ตรงกับที่กำหนด ก็ไปหน้า index
    return redirect()->route('index');
}
}