<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('equipment_usages', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_name');
            $table->enum('status', ['borrowed', 'returned'])->default('borrowed'); // การยืมหรือคืน
            $table->timestamps(); // created_at = วันที่ยืมหรือคืน
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_usages');
    }
};
