<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('job_applications', function (Blueprint $table) {

        $table->unsignedBigInteger('technician_id')->nullable()->after('shop_id');

        $table->foreign('technician_id')
            ->references('id')
            ->on('technicians')
            ->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('job_applications', function (Blueprint $table) {

        $table->dropForeign(['technician_id']);
        $table->dropColumn('technician_id');
    });
}
};