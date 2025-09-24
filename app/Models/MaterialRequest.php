<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'material_id',
        'quantity',
        'reason',
        'status',
        'approved_by',
    ];

    // ผู้ใช้ที่ส่งคำร้อง
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ผู้อนุมัติ (ถ้ามีระบบอนุมัติ)
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // วัสดุที่ถูกเบิก
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function items()
{
    return $this->hasMany(MaterialRequestItem::class);
}
}