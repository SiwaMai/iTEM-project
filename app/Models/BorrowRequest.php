<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'equipment_id',     // ✅ เพิ่มเพื่อให้สัมพันธ์กับอุปกรณ์
        'request_date',
        'borrow_date',
        'due_date',         // ✅ ใช้แทน return_date ถ้าเป็นกำหนดคืน
        'status',
        'quantity',         // ✅ ถ้ามีจำนวนที่ยืมในตารางนี้
    ];

    // ความสัมพันธ์กับ User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ความสัมพันธ์กับ Equipment (หนึ่งต่อหนึ่ง)
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    // ดึงชื่อครุภัณฑ์มาใช้แบบง่าย
    public function getEquipmentNameAttribute()
    {
        return $this->equipment ? $this->equipment->name : '-';
    }
}
