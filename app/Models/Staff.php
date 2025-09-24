<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $table = 'staff'; // ชื่อตารางในฐานข้อมูล
    protected $fillable = ['username', 'password', 'position']; // ฟิลด์ที่อนุญาตให้กรอกข้อมูล
}