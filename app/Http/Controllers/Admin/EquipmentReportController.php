<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class EquipmentReportController extends Controller
{
    // แสดงหน้ารายงานครุภัณฑ์ (หน้าธรรมดา)
    public function index()
    {
        $equipments = Equipment::with('category')->paginate(5);
        return view('admin.equipments.equipment-report', compact('equipments'));
    }

    // แสดง preview รายงาน PDF บนเบราว์เซอร์
    public function generatePdf()
    {
        $equipments = Equipment::with('category')->get();
        $staff = User::find(4);
        $head = User::find(5);

        $pdf = Pdf::loadView('admin.equipments.equipment-report-preview', compact('equipments', 'staff', 'head'))
                  ->setPaper('a4', 'landscape');

        return $pdf->stream('equipment_report.pdf');
    }

    // ดาวน์โหลดรายงาน PDF
    public function downloadPdf()
    {
        $equipments = Equipment::with('category')->get();
        $staff = User::find(4);
        $head = User::find(5);

        $pdf = Pdf::loadView('admin.equipments.equipment-report-preview', compact('equipments', 'staff', 'head'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('equipment_report.pdf');
    }
}