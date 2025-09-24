<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Equipment;
use App\Models\BorrowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class BorrowRequestController extends Controller
{
    // หน้าแสดงอุปกรณ์ที่สามารถยืม
    public function index()
    {
        $equipments = Equipment::where('quantity', '>', 0)->get();
        return view('borrow', compact('equipments'));
    }

    // หน้า confirm ยืม
    public function confirm(Equipment $equipment)
    {
        return view('confirm-borrow', compact('equipment'));
    }

    // submit คำขอยืม
    public function submit(Request $request, Equipment $equipment)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($request->quantity > $equipment->quantity) {
            return $request->expectsJson()
                ? response()->json(['message' => 'จำนวนครุภัณฑ์ไม่เพียงพอ'], 422)
                : redirect()->back()->with('error', 'จำนวนครุภัณฑ์ไม่เพียงพอ');
        }

        // ไม่ลด stock ทันที รอ admin อนุมัติ
        $borrowedAt = Carbon::now();
        $dueDate = $borrowedAt->copy()->addDays(7);

        $borrowRequest = BorrowRequest::create([
            'user_id' => Auth::id(),
            'equipment_id' => $equipment->id,
            'quantity' => $request->quantity,
            'reason' => $request->reason,
            'status' => 'pending',
            'borrowed_at' => $borrowedAt,
            'due_date' => $dueDate,
        ]);

        return $request->expectsJson()
            ? response()->json([
                'message' => 'ส่งคำขอยืมเรียบร้อยแล้ว',
                'data' => [
                    'equipment_name' => $equipment->name,
                    'quantity' => $borrowRequest->quantity,
                    'reason' => $borrowRequest->reason,
                    'status' => $borrowRequest->status,
                ]
            ])
            : redirect()->route('borrow.list')->with('success', 'ส่งคำขอยืมเรียบร้อยแล้ว');
    }

    // แสดงรายการยืมของผู้ใช้
    public function myBorrows()
    {
        $borrowRequests = BorrowRequest::with('equipment')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('borrow', compact('borrowRequests'));
    }

    // auto return สำหรับอุปกรณ์เกินเวลา (optional)
    public function autoReturnAvailable()
    {
        $equipments = Equipment::where('status', 'ถูกยืม')
            ->where('updated_at', '<=', now()->subDays(3)) // ตัวอย่างเกิน 3 วัน
            ->get();

        foreach ($equipments as $equipment) {
            $equipment->status = 'พร้อมใช้งาน';
            $equipment->save();
        }

        return response()->json(['message' => 'อัปเดตสถานะอุปกรณ์ครบ 3 วันเป็นพร้อมใช้งานแล้ว']);
    }

    // คืนอุปกรณ์
    public function returnEquipment(BorrowRequest $request)
    {
        $equipment = $request->equipment;
        $equipment->quantity += $request->quantity;

        if ($equipment->quantity > 0) {
            $equipment->status = 'พร้อมใช้งาน';
        }

        $equipment->save();

        $request->status = 'คืนแล้ว'; // หรือ 'returned'
        $request->returned_at = Carbon::now(); // บันทึกเวลา
        $request->save();

        return response()->json(['message' => 'คืนครุภัณฑ์เรียบร้อยแล้ว']);
    }

    // รายงานครุภัณฑ์เกินกำหนด
    public function overdueReport()
    {
        $overdueItems = BorrowRequest::with('equipment', 'user')
            ->whereDate('due_date', '<', Carbon::now())
            ->whereNull('returned_at')
            ->get();

        return view('reports.overdue', compact('overdueItems'));
    }

    public function downloadSlip($id)
    {
        $request = BorrowRequest::with(['user', 'equipment'])->findOrFail($id);

        if ($request->user_id !== Auth::id()) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงใบยืมนี้');
        }

        if ($request->status !== 'approved') {
            return back()->with('error', 'ใบยืมนี้ยังไม่ได้รับการอนุมัติ');
        }

        $staff = User::find(4);
        $head = User::find(5);

        $pdf = Pdf::loadView('admin.slip', compact('request', 'staff', 'head'));

        $userName = $request->user->name ?? 'ผู้ใช้ไม่ระบุ';
        $safeName = preg_replace('/[^ก-๙a-zA-Z0-9]/u', '_', $userName);
        $fileName = 'ใบยืมครุภัณฑ์_' . $safeName . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $fileName);
    }
}
