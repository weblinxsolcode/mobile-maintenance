<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use App\Services\BackupService;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $settings = \App\Models\BackupSetting::first();
    if (!$settings || $settings->auto_backup) {
        $backupService = new BackupService();
        $backupService->run(true); // auto backup
    }
})->daily();
