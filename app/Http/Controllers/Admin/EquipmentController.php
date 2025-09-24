<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $statusFilter = $request->input('status');

        $query = Equipment::with('category');

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('code', 'like', "%{$keyword}%")
                    ->orWhereHas('category', function ($cat) use ($keyword) {
                        $cat->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        if (!empty($statusFilter)) {
            $query->where('status', $statusFilter);
        }

        $equipments = $query->orderBy('code')->paginate(5);

        $statusSummary = [
            'พร้อมใช้งาน' => Equipment::where('status', 'พร้อมใช้งาน')->count(),
            'กำลังยืม' => Equipment::where('status', 'กำลังยืม')->count(),
            'ชำรุด' => Equipment::where('status', 'ชำรุด')->count(),
        ];

        $totalCount = array_sum($statusSummary);

        $categories = EquipmentCategory::all();

        return view('admin.equipments.equipment-info', compact(
            'equipments',
            'categories',
            'statusSummary',
            'totalCount'
        ));
    }

    public function create()
    {
        $categories = EquipmentCategory::all();
        return view('admin.equipments.equipment-add', compact('categories'));
    }

    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);
        $categories = EquipmentCategory::all();

        return view('admin.equipments.equipment-edit', compact('equipment', 'categories'));
    }

    public function update(Request $request, $id)
{
    try {
        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:equipment_categories,id',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|string|max:255',
            'unit' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'location' => 'nullable|string|max:255',
        ]);

        $equipment = Equipment::findOrFail($id);

        // จัดการรูปภาพใหม่
        $imagePath = $equipment->image;
        if ($request->hasFile('image')) {
            if ($equipment->image) {
                Storage::disk('public')->delete($equipment->image);
            }
            $imagePath = $request->file('image')->store('equipment_images', 'public');
        }

        $equipment->update([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'quantity' => $validated['quantity'],
            'status' => $validated['status'],
            'unit' => $validated['unit'],
            'location' => $validated['location'],
            'image' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'แก้ไขข้อมูลครุภัณฑ์เรียบร้อยแล้ว'
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'ข้อมูลไม่ครบถ้วน',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
        ], 500);
    }
}

    public function save(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:equipment_categories,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|string|max:255',
            'unit' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'location' => 'nullable|string|max:255',
        ]);

        $equipment = Equipment::where('code', $request->code)->first();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('equipment_images', 'public');
        }

        if ($equipment) {
            $equipment->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'quantity' => $equipment->quantity + $request->quantity,
                'status' => $request->status,
                'unit' => $request->unit,
                'location' => $request->location,
                'image' => $imagePath ?? $equipment->image,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'อัปเดตข้อมูลครุภัณฑ์เรียบร้อยแล้ว',
                'mode' => 'update'
            ]);
        } else {
            Equipment::create([
                'code' => $request->code,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'quantity' => $request->quantity,
                'available_quantity' => $request->quantity, // ตั้งค่าเริ่มต้น
                'status' => $request->status,
                'unit' => $request->unit,
                'location' => $request->location,
                'image' => $imagePath,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'เพิ่มครุภัณฑ์ใหม่เรียบร้อยแล้ว',
                'mode' => 'insert'
            ]);
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $equipments = Equipment::with('category')
            ->where('name', 'like', "%$keyword%")
            ->orWhere('code', 'like', "%$keyword%")
            ->get();

        return response()->json($equipments);
    }
}
