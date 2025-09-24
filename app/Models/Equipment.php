<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    protected $fillable = [
        'name',  
        'quantity', 
        'available_quantity', // เพิ่มให้ใช้เช็คจำนวนพร้อมยืม
        'status', 
        'category_id', 
        'code', 
        'image', 
        'location',
        'unit'
    ];

    /**
     * ความสัมพันธ์กับหมวดหมู่ครุภัณฑ์
     */
    public function category()
    {
        return $this->belongsTo(EquipmentCategory::class);
    }

    /**
     * ความสัมพันธ์แบบ many-to-many กับคำขอยืม
     */
   public function borrowRequests()
{
    return $this->belongsToMany(BorrowRequest::class, 'borrow_request_equipment')
                ->withPivot('quantity', 'due_date')
                ->withTimestamps();
}
}