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
        if (!Schema::hasColumn('job_applications', 'service_id')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->unsignedBigInteger('service_id')->nullable()->after('job_id');
                $table->foreign('service_id')
                    ->references('id')
                    ->on('services')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('job_applications', 'service_id')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->dropForeign(['service_id']);
                $table->dropColumn('service_id');
            });
        }
    }
};
