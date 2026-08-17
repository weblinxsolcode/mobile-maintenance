<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Scheduled Automatic Backup
|--------------------------------------------------------------------------
|
| The backup:run-auto command checks the BackupSetting.auto_backup flag
| before running. It runs daily at midnight.
|
| IMPORTANT — For this to fire automatically you must set up a scheduler:
|
| Windows Task Scheduler (run every minute):
|   Program : php
|   Arguments: C:\path\to\project\artisan schedule:run
|   Start in : C:\path\to\project
|
| Linux Cron (every minute):
|   * * * * * php /path/to/project/artisan schedule:run >> /dev/null 2>&1
|
*/

Schedule::command('backup:run-auto')
    ->daily()
    ->withoutOverlapping()
    ->runInBackground()
    ->onFailure(function () {
        \Illuminate\Support\Facades\Log::error('Scheduled backup:run-auto command failed.');
    });
