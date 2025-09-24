<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Equipment;

class DashboardController extends Controller
{
    public function index()
{
    if (!Auth::check()) {
        return redirect('/index');
    }
    $user = Auth::user();
    // ถ้า login แล้ว → แสดงหน้า dashboard
    return view('dashboard', compact('user'));
}
    

    public function getMaterialUsage()
    {
        $labels = DB::table('material_usages')
            ->select('material_name')
            ->groupBy('material_name')
            ->pluck('material_name');

        $data = [];

        foreach ($labels as $label) {
            $count = DB::table('material_usages')
                ->where('material_name', $label)
                ->sum('quantity'); // รวมจำนวน
            $data[] = $count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function getEquipmentUsage()
    {
        $labels = DB::table('equipment_usages')
            ->select('equipment_name')
            ->groupBy('equipment_name')
            ->pluck('equipment_name');

        $data = [];

        foreach ($labels as $label) {
            $count = DB::table('equipment_usages')
                ->where('equipment_name', $label)
                ->count(); // นับจำนวนรอบยืม-คืน
            $data[] = $count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

  /* public function search(Request $request)
   {
       $query = $request->input('query');

       $materials = Material::with('category')
           ->where('name', 'LIKE', "%{$query}%")
           ->orWhere('material_code', 'LIKE', "%{$query}%")
           ->get();

       $equipments = Equipment::where('name', 'LIKE', "%{$query}%")
           ->orWhere('code', 'LIKE', "%{$query}%")
           ->get();

       return response()->json([
           'query' => $query,
           'materials' => $materials,
           'equipments' => $equipments,
       ]);
   }    
       */

   
}
