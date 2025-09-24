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
    Schema::table('borrow_requests', function (Blueprint $table) {
        $table->string('slip_path')->nullable()->after('status');
    });
}

public function down()
{
    Schema::table('borrow_requests', function (Blueprint $table) {
        $table->dropColumn('slip_path');
    });
}
};
