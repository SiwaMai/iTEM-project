<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowRequest;
use Illuminate\Http\Request;
use App\Models\User;

class AdminBorrowRequestController extends Controller
{
    public function index()
    {
        // โหลดความสัมพันธ์ equipments และ user
        $requests = BorrowRequest::with('equipments', 'user')->orderByDesc('created_at')->get();
        return view('admin.borrow-request', compact('requests'));
    }

    public function approve($id)
    {
        // โหลดความสัมพันธ์ equipments ด้วย
        $request = BorrowRequest::with('equipments')->findOrFail($id);
        $request->status = 'approved';
        $request->save();

        // ลดจำนวนครุภัณฑ์ตามที่ยืม
        foreach ($request->equipments as $equipment) {
            if ($equipment->quantity >= $equipment->pivot->quantity) {
                $equipment->quantity -= $equipment->pivot->quantity;
                $equipment->save();
            }
        }

        return redirect()->route('admin.borrow.requests')->with('success', 'อนุมัติคำขอยืมเรียบร้อยแล้ว');
    }

    public function reject($id)
    {
        $request = BorrowRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        return redirect()->route('admin.borrow.requests')->with('success', 'ปฏิเสธคำขอยืมเรียบร้อยแล้ว');
    }
}