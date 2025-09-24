<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('borrow_request_equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrow_request_id')
                ->constrained('borrow_requests') // ระบุชื่อ table ให้ชัดเจน
                ->onDelete('cascade');
            $table->foreignId('equipment_id')
                ->constrained('equipments') // แก้จาก 'equipment' → 'equipments'
                ->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrow_request_equipment');
    }
};
