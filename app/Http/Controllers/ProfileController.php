<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; // เพิ่มการ import Storage
use App\Models\User;

class ProfileController extends Controller
{
    // ฟังก์ชันสำหรับแสดงข้อมูลส่วนตัว
    public function showProfile()
    {
        $user = Auth::user();
        // หากต้องการส่ง bgColor และ hoverColor ไปด้วย สามารถเพิ่มตรงนี้ได้
        // $bgColor = '#someColor';
        // $hoverColor = '#someHoverColor';
        // return view('profile', compact('user', 'bgColor', 'hoverColor'));
        return view('profile', compact('user'));
    }

    // ฟังก์ชันสำหรับอัปเดตข้อมูลและรูปภาพโปรไฟล์
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            // หากผู้ใช้ไม่ได้ล็อกอิน อาจจะ redirect ไปหน้า login หรือแสดง error
            // ในที่นี้ หากไม่มี $user จาก Auth::user() แสดงว่ามีบางอย่างผิดปกติมาก
            // อาจจะ redirect ไปหน้าหลักหรือหน้า login พร้อมข้อความ error
            return redirect()->route('index')->with('error', 'ไม่พบข้อมูลผู้ใช้ กรุณาล็อกอินใหม่');
        }
    
        // ตรวจสอบข้อมูลจากฟอร์ม
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'position' => 'required|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // ทำให้ profile_image ไม่บังคับ
        ]);
    
        try {
            $updateData = [
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'position' => $request->input('position'),
            ];

            // ตรวจสอบและจัดการการอัปโหลดรูปภาพ
            if ($request->hasFile('profile_image')) {
                // ลบรูปเก่า (ถ้ามี และไม่ใช่ค่า default หรือ placeholder)
                if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                    Storage::disk('public')->delete($user->profile_image);
                }
                
                // อัปโหลดรูปใหม่
                $imagePath = $request->file('profile_image')->store('profile_images', 'public');
                $updateData['profile_image'] = $imagePath;
            }

            // อัปเดตข้อมูลผู้ใช้
            // User::updateOrCreate(['id' => $user->id], $updateData); // หรือใช้ $user->update()
            if ($user instanceof \App\Models\User) {
                $user->fill($updateData);
                $user->save();
            }


            session()->flash('profile_success', 'ข้อมูลส่วนตัวของคุณได้รับการอัปเดตแล้ว');
            return redirect()->route('profile');
        } catch (\Exception $e) {
            Log::error('Error updating user profile: ' . $e->getMessage());
            session()->flash('profile_error', 'ไม่สามารถอัปเดตข้อมูลได้ กรุณาลองใหม่: ' . $e->getMessage());
            return redirect()->route('profile');
        }
    }

    // ฟังก์ชันสำหรับอัปโหลดรูปภาพ (อาจจะไม่จำเป็นแล้ว หากรวมใน updateProfile)
    /*
    public function updateImage(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            if ($request->hasFile('profile_image')) {
                // ลบรูปเก่า (ถ้ามี)
                if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                    Storage::disk('public')->delete($user->profile_image);
                }

                $image = $request->file('profile_image');
                $imagePath = $image->store('profile_images', 'public');

                $user->profile_image = $imagePath;
                // ตรวจสอบ instance ก่อน save เพื่อความแน่นอน (แม้ว่า Auth::user() ควรจะเป็น User model)
                if ($user instanceof \App\Models\User) {
                    $user->save();
                }
            }

            return redirect()->route('profile')->with('success', 'อัปโหลดรูปภาพสำเร็จ');
        } catch (\Exception $e) {
            Log::error('Error uploading profile image: ' . $e->getMessage());
            return redirect()->route('profile')->with('error', 'ไม่สามารถอัปโหลดรูปภาพได้ กรุณาลองใหม่');
        }
    }
    */

    // ฟังก์ชันสำหรับแสดงรูปภาพโปรไฟล์
    public function showProfileImage($id)
    {
        $user = User::findOrFail($id);

        // ตรวจสอบว่ามีรูปหรือไม่ และไฟล์รูปนั้นมีอยู่จริงใน storage
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            // return Storage::disk('public')->response($user->profile_image); // วิธีนี้จะจัดการ Content-Type ให้เอง
            $path = Storage::disk('public')->path($user->profile_image);
            return response()->file($path);
        }

        // หากไม่มีรูป หรือไฟล์ไม่มีอยู่จริง อาจจะแสดงรูป default หรือ 404
        // ตัวอย่าง: return response()->file(public_path('images/default-avatar.png'));
        return response()->json(['message' => 'No image found or image file missing'], 404);
    }

    // ฟังก์ชัน profile() นี้ดูเหมือนจะซ้ำซ้อนกับ showProfile()
    // หาก showProfile() ทำหน้าที่แสดงหน้าโปรไฟล์แล้ว ฟังก์ชันนี้อาจจะไม่จำเป็น
    // เว้นแต่ว่ามีการใช้งานที่แตกต่างกัน
    public function profile()
    {
        $user = Auth::user(); // ดึงข้อมูลผู้ใช้ที่ล็อกอินอยู่
        $bgColor = '#28a745'; // สีพื้นหลังปุ่ม (อาจจะไม่จำเป็นถ้าไม่ได้ใช้ใน view นี้โดยตรง)
        $hoverColor = '#218838'; // สีเมื่อ hover ปุ่ม (อาจจะไม่จำเป็นถ้าไม่ได้ใช้ใน view นี้โดยตรง)

        // ควรจะเรียกใช้ showProfile() หรือรวม logic เข้าด้วยกัน
        // return $this->showProfile(); 
        // หรือถ้า view 'profile' ต้องการ bgColor และ hoverColor จริงๆ ก็ส่งไป
        return view('profile', compact('user', 'bgColor', 'hoverColor'));
    }
}
