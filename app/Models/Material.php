<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'status', 'category_id', 'material_code', 'image', 'location', 'unit'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}