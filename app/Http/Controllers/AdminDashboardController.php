<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // ตรวจสอบว่า position เป็น admin หรือไม่
        if (!$user || $user->position !== 'admin') {
            return redirect()->route('admin.login')->withErrors(['access' => 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้']);
        }
    
        return view('admin.dashboard', compact('user'));
    }
}
