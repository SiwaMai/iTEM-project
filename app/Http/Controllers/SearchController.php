<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Equipment;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
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
}