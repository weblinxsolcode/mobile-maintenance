<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('backup_settings')) {
            Schema::table('backup_settings', function (Blueprint $table) {
                if (!Schema::hasColumn('backup_settings', 'last_media_backup_at')) {
                    $table->timestamp('last_media_backup_at')->nullable()->after('last_backup_at');
                }
                if (!Schema::hasColumn('backup_settings', 'media_interval_days')) {
                    $table->integer('media_interval_days')->default(7)->after('retention_days');
                }
            });
        }

        if (Schema::hasTable('backup_logs')) {
            Schema::table('backup_logs', function (Blueprint $table) {
                if (!Schema::hasColumn('backup_logs', 'content_type')) {
                    $table->string('content_type', 20)->default('db')->after('type');
                }
            });

            // Mark existing logs as 'full' since previously all backups included media files
            DB::table('backup_logs')->whereNull('content_type')->orWhere('content_type', '')->orWhere('content_type', 'db')->update([
                'content_type' => 'full'
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('backup_settings')) {
            Schema::table('backup_settings', function (Blueprint $table) {
                if (Schema::hasColumn('backup_settings', 'last_media_backup_at')) {
                    $table->dropColumn('last_media_backup_at');
                }
                if (Schema::hasColumn('backup_settings', 'media_interval_days')) {
                    $table->dropColumn('media_interval_days');
                }
            });
        }

        if (Schema::hasTable('backup_logs')) {
            Schema::table('backup_logs', function (Blueprint $table) {
                if (Schema::hasColumn('backup_logs', 'content_type')) {
                    $table->dropColumn('content_type');
                }
            });
        }
    }
};
