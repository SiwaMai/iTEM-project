<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MaterialCategory;
use Illuminate\Validation\Rule;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $statusFilter = $request->input('status');

        $query = Material::with('category');

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('material_code', 'like', "%{$keyword}%")
                    ->orWhereHas('category', function ($cat) use ($keyword) {
                        $cat->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        if (!empty($statusFilter)) {
            $query->where('status', $statusFilter);
        }

        $materials = $query->orderBy('material_code')->paginate(5);
        $categories = Category::all();

        // 📊 สรุปยอดตามสถานะ
        $statusSummary = [
            'พร้อมใช้งาน' => Material::where('status', 'พร้อมใช้งาน')->count(),
            'หมดคลัง' => Material::where('status', 'หมดคลัง')->count(),
            'ชำรุด' => Material::where('status', 'ชำรุด')->count(),
        ];

        $totalCount = array_sum($statusSummary);

        // 🚨 ตรวจสอบวัสดุที่หมดคลัง
        $lowStockMaterials = Material::where('status', 'หมดคลัง')->pluck('name')->toArray();

        return view('admin.materials.material-info', compact(
            'materials',
            'categories',
            'statusSummary',
            'totalCount',
            'lowStockMaterials'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'material_code' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit' => 'nullable|string|in:อัน,ชิ้น,กล่อง,แพ็ค',
            'status' => 'required|string|in:พร้อมใช้งาน,หมดคลัง,รอเติมคลัง,ยกเลิกการใช้งาน',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'location' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('materials', 'public');
        }

        $existing = Material::where('material_code', $validated['material_code'])->first();

        if ($existing) {
            $existing->update([
                'quantity' => $existing->quantity + $validated['quantity'],
                'name' => $validated['name'],
                'unit' => $validated['unit'],
                'status' => $validated['status'],
                'category_id' => $validated['category_id'],
                'location' => $validated['location'],
                'image' => $validated['image'] ?? $existing->image,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'มีรหัสนี้อยู่แล้ว ระบบได้รวมจำนวนวัสดุให้เรียบร้อย',
                'mode' => 'update'
            ]);
        }

        Material::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'เพิ่มวัสดุใหม่เรียบร้อยแล้ว',
            'mode' => 'insert'
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'quantity' => 'required|integer|min:1',
                // ❌ ไม่ validate unit เพราะไม่ให้แก้
                'status' => 'required|string|in:พร้อมใช้งาน,หมดคลัง,รอเติมคลัง,ยกเลิกการใช้งาน',
                'category_id' => 'required|exists:categories,id',
                'material_code' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('materials', 'material_code')->ignore($id),
                ],
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'location' => 'nullable|string|max:255',
            ]);

            $material = Material::findOrFail($id);

            $data = $request->only([
                'name',
                'material_code',
                'quantity',
                'status',
                'category_id',
                'location'
                // ❌ ไม่รวม unit
            ]);

            if ($request->hasFile('image')) {
                if ($material->image) {
                    Storage::disk('public')->delete($material->image);
                }
                $data['image'] = $request->file('image')->store('materials', 'public');
            }

            $material->update($data);

            return response()->json([
                'success' => true,
                'message' => 'ระบบได้แก้ไขข้อมูลวัสดุเรียบร้อยแล้ว'
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);

        // ลบรูปภาพ (ถ้ามี)
        if ($material->image) {
            Storage::disk('public')->delete($material->image);
        }

        $material->delete();
        return redirect()->route('admin.materials.index')->with('success', 'ลบวัสดุสำเร็จ!');
    }
    public function destroySelected(Request $request)
    {
        $ids = $request->input('ids');
        Material::whereIn('id', $ids)->delete();

        return response()->json((['success' => true,]));
    }
    public function request($id)
    {
        // ดำเนินการเบิกจ่ายวัสดุ
        $material = Material::find($id);
        if ($material) {
            // Logic สำหรับเบิกจ่าย
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function create()
    {
        $categories = Category::all(); // ดึงประเภทวัสดุ
        return view('admin.materials.material-add', compact('categories'));
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id); // ดึงวัสดุตาม ID
        $categories = Category::all(); // ดึงประเภทวัสดุทั้งหมด

        return view('admin.materials.material-edit', compact('material', 'categories'));
    }
}
