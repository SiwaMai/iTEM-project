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
    Schema::table('equipments', function (Blueprint $table) {
        $table->dropColumn('type'); // ลบฟิลด์ type
    });
}

public function down()
{
    Schema::table('equipments', function (Blueprint $table) {
        $table->string('type')->nullable(); // เพิ่มฟิลด์ type กลับมาในกรณีที่ต้องการ rollback
    });
}
};
