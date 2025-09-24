<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\MaterialRequest;
use Illuminate\Support\Facades\Auth;



class MaterialRequestController extends Controller
{
    public function create()
    {
        $materials = Material::all();
        return view('materials.request.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255',
        ]);

        try {
            $material = Material::findOrFail($request->material_id);

            // ✅ ตรวจสอบว่าเบิกไม่เกินจำนวนคงเหลือ
            if ($request->quantity > $material->quantity) {
                $message = 'จำนวนที่ต้องการเบิกมากกว่าจำนวนคงเหลือ';

                if ($request->expectsJson()) {
                    return response()->json(['message' => $message], 422);
                }

                return redirect()->back()->with('error', $message);
            }

            // ✅ ลด stock ทันที
            $material->decrement('quantity', $request->quantity);

            // ✅ บันทึกคำร้อง
            $materialRequest = MaterialRequest::create([
                'user_id' => Auth::id(),
                'material_id' => $request->material_id,
                'quantity' => $request->quantity,
                'reason' => $request->reason,
                'status' => 'pending',
            ]);

            $successMessage = 'ยืนยันการเบิกสำเร็จแล้ว';

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $successMessage,
                    'data' => [
                        'material_name' => $material->name,
                        'quantity' => $materialRequest->quantity,
                        'unit' => $material->unit,
                        'reason' => $materialRequest->reason,
                        'status' => $materialRequest->status,
                    ]
                ]);
            }

            return redirect()->route('admin.material-requests.index')->with('success', $successMessage);
        } catch (\Exception $e) {
            $errorMessage = 'ไม่สามารถส่งคำร้องได้: ' . $e->getMessage();

            if ($request->expectsJson()) {
                return response()->json(['message' => $errorMessage], 500);
            }

            return redirect()->back()->with('error', $errorMessage);
        }
    }

    public function myMaterials()
    {
        $materialRequests = MaterialRequest::with('material')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('request-history', compact('materialRequests'));
    }

    public function confirmRequest($id)
    {
        $material = Material::findOrFail($id);
        return view('confirm-request', compact('material'));
    }
}
