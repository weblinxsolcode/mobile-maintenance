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
                            {--force : Force run regardless of interval}
                            {--media : Force include media/images (Full backup)}
                            {--db-only : Force database-only backup}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run automatic backups: Database backup every 24 hours, Media backup weekly.';

    /**
     * Execute the console command.
     *
     * Schedule Logic:
     *  - Scheduler checks this command frequently (e.g. every minute or hourly).
     *  - Checks if auto_backup is enabled.
     *  - Database Backup: Runs every 24 hours (1,440 minutes).
     *  - Media/Images Backup: Runs weekly (every 7 days) to conserve storage and reduce backup size.
     */
    public function handle(): int
    {
        $settings = BackupSetting::first();

        // If no settings exist, create defaults with auto_backup ON
        if (!$settings) {
            $settings = BackupSetting::create([
                'auto_backup'         => true,
                'external_path'       => null,
                'retention_days'      => 7,
                'media_interval_days' => 7,
            ]);
        }

        // ── 1. Check if auto_backup is enabled ──────────────────────────────
        if (!$this->option('force') && !$settings->auto_backup) {
            $this->info('[Backup] Auto-backup is disabled in settings. Skipping.');
            Log::info('Scheduled backup skipped: auto_backup is disabled.');
            return Command::SUCCESS;
        }

        // ── 2. Check 24-hour interval for Database Backup ────────────────────
        $dbIntervalMinutes = 1440; // 24 hours

        if (!$this->option('force') && $settings->last_backup_at !== null) {
            $minutesSinceLast = (int) abs(Carbon::now()->diffInMinutes($settings->last_backup_at));

            if ($minutesSinceLast < $dbIntervalMinutes) {
                $hoursRemaining = round(($dbIntervalMinutes - $minutesSinceLast) / 60, 1);
                $this->info("[Backup] 24-hour interval not reached yet. Last backup: {$settings->last_backup_at->toDateTimeString()}. Next daily run in ~{$hoursRemaining} hour(s).");
                return Command::SUCCESS;
            }
        }

        // ── 3. Determine if Media should be included (Weekly) ───────────────
        $mediaIntervalDays = (int) ($settings->media_interval_days ?? 7);
        $mediaIntervalDays = max(1, $mediaIntervalDays);

        $includeMedia = false;
        if ($this->option('media')) {
            $includeMedia = true;
        } elseif ($this->option('db-only')) {
            $includeMedia = false;
        } else {
            // Check if 7 days have passed since the last media backup
            if ($settings->last_media_backup_at === null) {
                // If never run before, take a full backup
                $includeMedia = true;
            } else {
                $daysSinceLastMedia = (int) abs(Carbon::now()->diffInDays($settings->last_media_backup_at));
                if ($daysSinceLastMedia >= $mediaIntervalDays) {
                    $includeMedia = true;
                }
            }
        }

        $modeLabel = $includeMedia ? 'Weekly FULL (Database + Media)' : 'Daily DATABASE-ONLY (~1-2 MB)';
        $this->info("[Backup] Starting automatic backup: {$modeLabel}...");
        Log::info("Scheduled backup started: mode={$modeLabel}.");

        // ── 4. Execute the backup ───────────────────────────────────────────
        $service = new BackupService();
        $result  = $service->run(true, $includeMedia);

        if ($result['success']) {
            $this->info("[Backup] SUCCESS — {$result['filename']} ({$result['size']}) [{$result['content_type']}] in {$result['duration']}");
            Log::info("Scheduled backup succeeded: {$result['filename']} ({$result['size']}) in {$result['duration']}");
            return Command::SUCCESS;
        }

        $this->error("[Backup] FAILED — {$result['error']}");
        Log::error("Scheduled backup failed: {$result['error']}");
        return Command::FAILURE;
    }
}
