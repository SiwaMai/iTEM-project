<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\BorrowRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Equipment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AdminBorrowRequestController extends Controller
{
    public function index()
    {
        // 🔄 ตรวจสอบคำขอที่ค้างเกิน 2 วัน แล้วเปลี่ยนสถานะเป็น rejected
        $this->autoRejectStaleRequests();

        // ✅ preload ความสัมพันธ์ user และ equipment เพื่อใช้ใน Blade
        $requests = BorrowRequest::with(['user', 'equipment'])->get();

        // 🔍 ส่งข้อมูลไปยัง view admin.borrow-request
        return view('admin.borrow-request', compact('requests'));
    }

    public function approve($id)
    {
        $request = BorrowRequest::with('equipment')->findOrFail($id);

        if (!$request->equipment) {
            return back()->with('error', 'ไม่พบครุภัณฑ์ที่ต้องการยืม');
        }

        if ($request->equipment->quantity < $request->quantity) {
            return back()->with('error', 'ครุภัณฑ์นี้มีจำนวนไม่เพียงพอ');
        }

        // ลดจำนวนคงเหลือ
        $request->equipment->quantity -= $request->quantity;

        // ถ้าของหมด → เปลี่ยนสถานะเป็น "กำลังยืม"
        if ($request->equipment->quantity <= 0) {
            $request->equipment->status = 'กำลังยืม';
        }

        $request->equipment->save();

        // อัปเดตคำขอ
        $request->status = 'approved';
        $request->borrowed_at = now();
        $request->due_date = now()->addDays(7);
        $request->save();

        return back()->with('success', 'อนุมัติคำขอเรียบร้อยแล้ว');
    }

    public function reject($id)
    {
        $request = BorrowRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        return back()->with('success', 'ปฏิเสธคำขอเรียบร้อยแล้ว');
    }

    public function returnEquipment($id): JsonResponse
    {
        try {
            $request = BorrowRequest::with('equipment')->findOrFail($id);

            if ($request->status !== 'approved') {
                return response()->json([
                    'success' => false,
                    'message' => 'ไม่สามารถคืนครุภัณฑ์ที่ยังไม่ได้อนุมัติได้'
                ], 400);
            }

            if (!$request->equipment) {
                return response()->json([
                    'success' => false,
                    'message' => 'ไม่พบข้อมูลครุภัณฑ์ที่เกี่ยวข้อง'
                ], 404);
            }

            // เพิ่มจำนวนกลับเข้าไป
            $returnQty = $request->quantity ?: 1;
            $equipment = $request->equipment;
            $equipment->quantity += $returnQty;

            // ตรวจสอบว่ามีคำขออื่นที่ยังไม่คืนหรือไม่
            $stillBorrowed = BorrowRequest::where('equipment_id', $equipment->id)
                ->where('status', 'approved')
                ->where('id', '!=', $request->id)
                ->exists();

            // ถ้าไม่มีคำขอที่ยังยืมอยู่ → เปลี่ยนสถานะเป็น "พร้อมใช้งาน"
            $equipment->status = $stillBorrowed ? 'กำลังยืม' : 'พร้อมใช้งาน';
            $equipment->save();

            // อัปเดตสถานะคำขอ
            $request->status = 'returned';
            $request->returned_at = now();
            $request->save();

            return response()->json([
                'success' => true,
                'message' => 'คืนครุภัณฑ์เรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {
            Log::error('คืนครุภัณฑ์ล้มเหลว: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาดในการคืนครุภัณฑ์'
            ], 500);
        }
    }

    public function autoRejectStaleRequests()
    {
        $threshold = now()->subDays(2);

        BorrowRequest::where('status', 'pending')
            ->where('created_at', '<=', $threshold)
            ->update(['status' => 'rejected']);
    }

    public function generateSlip($id)
    {
        $request = BorrowRequest::with(['user', 'equipment'])->findOrFail($id);

        $staff = User::find(4);
        $head = User::find(5);

        $pdf = Pdf::loadView('admin.slip', compact('request', 'staff', 'head'));

        // ✅ สร้างชื่อไฟล์และ path
        $fileName = 'slips/slip_' . $request->id . '.pdf';

        // ✅ บันทึกไฟล์ลง storage
        Storage::put($fileName, $pdf->output());

        // ✅ บันทึก path ลงในฐานข้อมูล
        $request->slip_path = $fileName;
        $request->save();

        return back()->with('success', 'สร้างใบยืมเรียบร้อยแล้ว');
    }

    public function downloadSlipPdf($id)
    {
        $request = BorrowRequest::with(['user', 'equipment'])->findOrFail($id);

        if ($request->status !== 'approved') {
            return redirect()->back()->with('error', 'อนุมัติแล้วเท่านั้นถึงจะดาวน์โหลดใบยืมได้');
        }

        $staff = User::find(4);
        $head = User::find(5);

        $pdf = Pdf::loadView('admin.slip', compact('request', 'staff', 'head'));

        // สร้างชื่อไฟล์จากชื่อผู้ใช้
        $userName = $request->user->name ?? 'ผู้ใช้ไม่ระบุ';
        $safeName = preg_replace('/[^ก-๙a-zA-Z0-9]/u', '_', $userName); // แทนอักขระพิเศษด้วย "_"

        $fileName = 'ใบยืมครุภัณฑ์_' . $safeName . '.pdf';

        return $pdf->download($fileName);
    }
}
