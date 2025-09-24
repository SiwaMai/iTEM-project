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
        Schema::table('borrow_requests', function (Blueprint $table) {
            $table->date('due_date')->nullable()->after('status');       // วันที่ต้องคืน
            $table->timestamp('borrowed_at')->nullable()->after('due_date'); // วันที่เริ่มยืม
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrow_requests', function (Blueprint $table) {
            $table->dropColumn(['due_date', 'borrowed_at']);
        });
    }
};