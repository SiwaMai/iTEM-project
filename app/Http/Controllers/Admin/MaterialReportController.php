<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class MaterialReportController extends Controller
{
    // แสดงหน้ารายงานวัสดุ (หน้าธรรมดา)
    public function index()
    {
        $materials = Material::with('category')->paginate(5);
        return view('admin.materials.material-report', compact('materials'));
    }

    // แสดง preview รายงาน PDF บนเบราว์เซอร์
    public function generatePdf()
{
    $materials = Material::with('category')->get();
    $staff = User::find(4);
    $head = User::find(5);

    $pdf = Pdf::loadView('admin.materials.material-report-preview', compact('materials', 'staff', 'head'))
              ->setPaper('a4', 'landscape');

    return $pdf->stream('material_report.pdf');
}

public function downloadPdf()
{
    $materials = Material::with('category')->get();
    $staff = User::find(4);
    $head = User::find(5);

    $pdf = Pdf::loadView('admin.materials.material-report-preview', compact('materials', 'staff', 'head'))
              ->setPaper('a4', 'landscape');

    return $pdf->download('material_report.pdf');
}
}