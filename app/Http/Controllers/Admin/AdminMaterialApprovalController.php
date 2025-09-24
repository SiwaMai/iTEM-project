<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaterialRequest;
use App\Models\Material;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class AdminMaterialApprovalController extends Controller
{
    public function index()
    {
        $requests = MaterialRequest::with(['material', 'user'])->get();

        return view('admin.material-request', compact('requests'));
    }

    public function approve($id)
    {
        $request = MaterialRequest::with('items.material')->findOrFail($id);

        // ตรวจสอบว่าวัสดุแต่ละรายการมีจำนวนเพียงพอ
        foreach ($request->items as $item) {
            $material = $item->material;
            if ($material->available_quantity < $item->quantity) {
                return redirect()->back()->with('error', 'วัสดุ "' . $material->name . '" มีไม่เพียงพอ');
            }
        }

        // ใช้ transaction เพื่อความปลอดภัย
        DB::transaction(function () use ($request) {
            // หักสต็อกวัสดุ
            foreach ($request->items as $item) {
                $material = $item->material;
                $material->available_quantity -= $item->quantity;
                $material->save();
            }

            // อัปเดตสถานะคำร้อง
            $request->status = 'approved';
            $request->save();
        });

        return redirect()->back()->with('success', 'อนุมัติคำร้องเรียบร้อยแล้ว');
    }

    public function reject($id)
    {
        $request = MaterialRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        return redirect()->back()->with('success', 'ปฏิเสธคำร้องเรียบร้อยแล้ว');
    }

    public function showSlip($id)
    {
        $request = MaterialRequest::with(['items.material', 'user'])->findOrFail($id);
        $staff = User::find(4);
        $head = User::find(5);

        $fontPath = str_replace('\\', '/', storage_path('fonts/THSarabunNew.ttf'));
        $fontBoldPath = str_replace('\\', '/', storage_path('fonts/THSarabunNew Bold.ttf'));

        $pdf = Pdf::loadView('admin.material_slip', compact('request', 'staff', 'head', 'fontPath', 'fontBoldPath'));

        return $pdf->stream('material_slip_' . $request->id . '.pdf');
    }

    public function generateSlipPdf($id)
    {
        $request = MaterialRequest::with(['items.material', 'user'])->findOrFail($id);
        $staff = User::find(4);
        $head = User::find(5);

        $fontPath = str_replace('\\', '/', storage_path('fonts/THSarabunNew.ttf'));
        $fontBoldPath = str_replace('\\', '/', storage_path('fonts/THSarabunNew Bold.ttf'));

        $pdf = Pdf::loadView('admin.material_slip', compact('request', 'staff', 'head', 'fontPath', 'fontBoldPath'));

        return $pdf->stream('material_slip_' . $request->id . '.pdf');
    }

    public function downloadSlipPdf($id)
    {
        $request = MaterialRequest::with(['items.material', 'user'])->findOrFail($id);

        if ($request->status !== 'approved') {
            return redirect()->back()->with('error', 'สามารถดาวน์โหลดได้เฉพาะคำขอที่อนุมัติแล้วเท่านั้น');
        }

        $staff = User::find(4);
        $head = User::find(5);

        $fontPath = str_replace('\\', '/', storage_path('fonts/THSarabunNew.ttf'));
        $fontBoldPath = str_replace('\\', '/', storage_path('fonts/THSarabunNew Bold.ttf'));

        $pdf = Pdf::loadView('admin.material_slip_pdf', compact('request', 'staff', 'head', 'fontPath', 'fontBoldPath'));

        return $pdf->download('material_slip_' . $request->id . '.pdf');
    }
}