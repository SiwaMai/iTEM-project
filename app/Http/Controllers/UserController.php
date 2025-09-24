<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // แสดงหน้ารายชื่อผู้ใช้ทั้งหมด
    public function index()
    {
        $users = User::all(); // ดึงข้อมูลผู้ใช้ทั้งหมดจาก DB
        return view('admin.user', compact('users')); // ส่งข้อมูลไปที่ view user.blade.php
    }

    // อัปเดตข้อมูลผู้ใช้แบบ Ajax
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'position' => 'required',
            'username' => 'required',
            'profile_image' => 'nullable|image',
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->phone = $request->phone;
        $user->position = $request->position;
        $user->username = $request->username;

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return response()->json([
            'name' => $user->name,
            'surname' => $user->surname,
            'phone' => $user->phone,
            'position' => $user->position,
            'username' => $user->username,
            'profile_image_url' => $user->profile_image ? asset('storage/' . $user->profile_image) : null,
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'ลบผู้ใช้เรียบร้อยแล้ว');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
}
