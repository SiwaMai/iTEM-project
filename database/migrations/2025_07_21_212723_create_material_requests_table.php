<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('material_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ผู้ส่งคำร้อง
        $table->foreignId('material_id')->constrained()->onDelete('cascade'); // วัสดุที่ขอเบิก
        $table->integer('quantity'); // จำนวนที่ขอ
        $table->string('reason')->nullable(); // เหตุผล
        $table->enum('status', ['pending', 'confirmed', 'approved', 'rejected'])->default('pending');
        $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete(); // ผู้อนุมัติ
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_requests');
    }
};
