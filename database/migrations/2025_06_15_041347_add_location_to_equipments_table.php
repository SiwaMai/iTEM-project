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
        $table->string('location')->nullable()->after('name'); // หรือหลัง column อื่นที่เหมาะสม
    });
}

public function down()
{
    Schema::table('equipments', function (Blueprint $table) {
        $table->dropColumn('location');
    });
}
};
