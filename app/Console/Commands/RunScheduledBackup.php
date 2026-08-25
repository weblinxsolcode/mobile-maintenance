<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BackupService;
use App\Models\BackupSetting;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RunScheduledBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:run-auto
                            {--force : Force run regardless of auto_backup setting or interval}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the automatic scheduled backup based on the retention_days interval.';

    /**
     * Execute the console command.
     *
     * Logic:
     *  - Scheduler fires this command EVERY MINUTE.
     *  - The backup is generated if auto_backup is enabled in settings.
     *  - Old backups exceeding the `retention_days` limit are cleaned up.
     */
    public function handle(): int
    {
        $settings = BackupSetting::first();

        // If no settings exist, create defaults with auto_backup ON
        if (!$settings) {
            $settings = BackupSetting::create([
                'auto_backup'    => true,
                'external_path'  => null,
                'retention_days' => 7,
            ]);
        }

        // ── 1. Check if auto_backup is enabled ──────────────────────────────
        if (!$this->option('force') && !$settings->auto_backup) {
            $this->info('[Backup] Auto-backup is disabled in settings. Skipping.');
            Log::info('Scheduled backup skipped: auto_backup is disabled.');
            return Command::SUCCESS;
        }

        // ── 2. Check if enough days have passed since last backup ────────────
        $intervalDays = (int) ($settings->retention_days ?? 1);
        $intervalDays = max(1, $intervalDays); // safety: never less than 1

        if (!$this->option('force') && $settings->last_backup_at !== null) {
            $daysSinceLast = (int) Carbon::now()->diffInDays($settings->last_backup_at);

            if ($daysSinceLast < $intervalDays) {
                $nextBackupIn = $intervalDays - $daysSinceLast;
                $this->info("[Backup] Interval not reached yet. Last backup: {$settings->last_backup_at->toDateTimeString()}. Next backup in {$nextBackupIn} day(s). (Interval: every {$intervalDays} day(s))");
                Log::info("Scheduled backup skipped: interval not reached. Last backup {$daysSinceLast}d ago, interval is every {$intervalDays}d.");
                return Command::SUCCESS;
            }
        }

        // ── 3. Run the backup ────────────────────────────────────────────────
        $this->info("[Backup] Starting automatic scheduled backup (Interval: {$intervalDays} days)...");
        Log::info("Scheduled backup started.");

        $service = new BackupService();
        $result  = $service->run(true);

        if ($result['success']) {
            $this->info("[Backup] SUCCESS — {$result['filename']} ({$result['size']}) in {$result['duration']}");
            Log::info("Scheduled backup succeeded: {$result['filename']} ({$result['size']}) in {$result['duration']}");
            return Command::SUCCESS;
        }

        $this->error("[Backup] FAILED — {$result['error']}");
        Log::error("Scheduled backup failed: {$result['error']}");
        return Command::FAILURE;
    }
}
