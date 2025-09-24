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
        $table->string('code')->unique(); // เพิ่มฟิลด์ code และทำให้มันเป็นค่าเฉพาะ
    });
}

public function down()
{
    Schema::table('equipments', function (Blueprint $table) {
        $table->dropColumn('code'); // ลบฟิลด์ code ถ้าต้องการ rollback
    });
}
};
