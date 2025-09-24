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
    Schema::create('equipments', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('type');
        $table->integer('quantity');
        $table->string('status');
        $table->foreignId('category_id')->constrained('equipment_categories')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
