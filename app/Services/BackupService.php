<?php

namespace App\Services;

use App\Models\BackupSetting;
use App\Models\BackupLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use ZipArchive;

class BackupService
{
    /**
     * Run the backup process.
     *
     * @param bool $isAuto Set true if triggered by scheduler
     * @return array Result summary
     */
    public function run(bool $isAuto = false): array
    {
        $type = $isAuto ? 'auto' : 'manual';
        $startTime = microtime(true);
        
        // Ensure backups directory exists
        $backupsDir = storage_path('app/backups');
        if (!file_exists($backupsDir)) {
            mkdir($backupsDir, 0755, true);
        }

        // Load active settings
        $settings = BackupSetting::first();
        if (!$settings) {
            $settings = BackupSetting::create([
                'auto_backup' => true,
                'external_path' => null,
                'retention_days' => 7,
            ]);
        }

        // Generate dynamic filename
        $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
        $filename = "backup_{$type}_{$timestamp}.zip";
        $zipPath = $backupsDir . '/' . $filename;

        // Temporary SQL file path
        $tempSqlFile = storage_path('app/backups/temp_db_backup.sql');

        try {
            // 1. GENERATE SQL DUMP
            $sqlDump = "-- Mobile Maintenance System Database Backup\n";
            $sqlDump .= "-- Generated on " . Carbon::now()->toDateTimeString() . "\n";
            $sqlDump .= "-- -----------------------------------------------------\n\n";
            $sqlDump .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            // Get all database tables
            $tables = [];
            $tablesResult = DB::select("SHOW TABLES");
            foreach ($tablesResult as $row) {
                $tables[] = array_values((array)$row)[0];
            }

            foreach ($tables as $table) {
                // Drop if exists statement
                $sqlDump .= "DROP TABLE IF EXISTS `{$table}`;\n";

                // Show Create Table
                $createTableResult = DB::select("SHOW CREATE TABLE `{$table}`");
                $createTableSql = array_values((array)$createTableResult[0])[1];
                $sqlDump .= $createTableSql . ";\n\n";

                // Fetch table row inserts
                $rows = DB::select("SELECT * FROM `{$table}`");
                if (count($rows) > 0) {
                    foreach ($rows as $row) {
                        $rowArr = (array)$row;
                        $columns = array_keys($rowArr);
                        $escapedValues = array_map(function($val) {
                            if (is_null($val)) return 'NULL';
                            // Escape quotes and backslashes safely for SQL insertion
                            $escaped = str_replace(
                                ["\\", "'", "\n", "\r", "\t", "\x00", "\x1a"],
                                ["\\\\", "\'", "\\n", "\\r", "\\t", "\\0", "\\Z"],
                                $val
                            );
                            return "'{$escaped}'";
                        }, array_values($rowArr));

                        $colNames = implode('`, `', $columns);
                        $valList = implode(', ', $escapedValues);
                        $sqlDump .= "INSERT INTO `{$table}` (`{$colNames}`) VALUES ({$valList});\n";
                    }
                    $sqlDump .= "\n";
                }
            }

            $sqlDump .= "SET FOREIGN_KEY_CHECKS=1;\n";

            // Write temporary SQL to file
            file_put_contents($tempSqlFile, $sqlDump);

            // 2. CREATE ZIP FILE
            $zip = new ZipArchive();
            if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
                throw new \Exception("Could not create ZIP file at: " . $zipPath);
            }

            // Add the database SQL file
            $zip->addFile($tempSqlFile, 'database_backup.sql');

            // Add uploaded media files from public directories
            $uploadDirs = [
                'shops' => public_path('shops'),
                'jobs' => public_path('jobs'),
                'userImages' => public_path('userImages'),
            ];

            foreach ($uploadDirs as $localName => $fullPath) {
                if (file_exists($fullPath) && is_dir($fullPath)) {
                    $files = new \RecursiveIteratorIterator(
                        new \RecursiveDirectoryIterator($fullPath, \RecursiveDirectoryIterator::SKIP_DOTS),
                        \RecursiveIteratorIterator::LEAVES_ONLY
                    );

                    foreach ($files as $file) {
                        if (!$file->isDir()) {
                            $filePath = $file->getRealPath();
                            $relativePath = 'uploads/' . $localName . '/' . substr($filePath, strlen($fullPath) + 1);
                            $zip->addFile($filePath, $relativePath);
                        }
                    }
                }
            }

            // Close zip archive
            $zip->close();

            // Clean up temporary SQL file
            if (file_exists($tempSqlFile)) {
                unlink($tempSqlFile);
            }

            // 3. COPY TO EXTERNAL STORAGE (IF CONFIGURED)
            $externalPath = null;
            if (!empty($settings->external_path)) {
                $extDir = rtrim($settings->external_path, '/\\');
                
                if (file_exists($extDir) && is_dir($extDir) && is_writable($extDir)) {
                    $externalPath = $extDir . DIRECTORY_SEPARATOR . $filename;
                    copy($zipPath, $externalPath);
                } else {
                    Log::warning("Backup Service: External path is not writable or does not exist: {$extDir}");
                }
            }

            // Get file size
            $bytes = filesize($zipPath);
            $units = ['B', 'KB', 'MB', 'GB'];
            for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
                $bytes /= 1024;
            }
            $readableSize = round($bytes, 2) . ' ' . $units[$i];

            // 4. SAVE LOG ENTRY
            BackupLog::create([
                'filename' => $filename,
                'path' => 'backups/' . $filename,
                'external_path' => $externalPath,
                'size' => $readableSize,
                'type' => $type,
                'status' => 'success',
            ]);

            // Update settings last_backup timestamp
            $settings->update([
                'last_backup_at' => Carbon::now(),
            ]);

            // 5. HOUSEKEEPING (CLEANUP OLD BACKUPS)
            $this->cleanup($settings->retention_days);

            return [
                'success' => true,
                'filename' => $filename,
                'size' => $readableSize,
                'external_path' => $externalPath,
                'duration' => round(microtime(true) - $startTime, 2) . 's',
            ];

        } catch (\Throwable $th) {
            // Clean up files in case of failures
            if (file_exists($tempSqlFile)) {
                unlink($tempSqlFile);
            }
            if (file_exists($zipPath)) {
                unlink($zipPath);
            }

            // Log database failure
            BackupLog::create([
                'filename' => $filename,
                'path' => 'backups/' . $filename,
                'size' => '0 B',
                'type' => $type,
                'status' => 'failed',
                'error_message' => $th->getMessage(),
            ]);

            Log::error("Backup Service failure: " . $th->getMessage(), [
                'trace' => $th->getTraceAsString()
            ]);

            return [
                'success' => false,
                'error' => $th->getMessage(),
            ];
        }
    }

    /**
     * Delete backups older than specified retention limit.
     *
     * @param int $days
     */
    protected function cleanup(int $days)
    {
        $cutoff = Carbon::now()->subDays($days);
        $oldLogs = BackupLog::where('status', 'success')
            ->where('created_at', '<', $cutoff)
            ->get();

        foreach ($oldLogs as $log) {
            // Delete local file
            $localFullPath = storage_path('app/' . $log->path);
            if (file_exists($localFullPath)) {
                unlink($localFullPath);
            }

            // Delete external file if possible
            if (!empty($log->external_path) && file_exists($log->external_path)) {
                unlink($log->external_path);
            }

            // Delete database log entry
            $log->delete();
        }
    }

    /**
     * Restore the system from a previous backup.
     *
     * @param int $logId
     * @return array
     */
    public function restore(int $logId): array
    {
        $startTime = microtime(true);
        $log = BackupLog::find($logId);
        if (!$log) {
            return ['success' => false, 'error' => 'Backup record not found.'];
        }

        $zipPath = storage_path('app/' . $log->path);
        
        // If zip is not available locally, try external
        if (!file_exists($zipPath)) {
            if (!empty($log->external_path) && file_exists($log->external_path)) {
                $backupsDir = storage_path('app/backups');
                if (!file_exists($backupsDir)) {
                    mkdir($backupsDir, 0755, true);
                }
                copy($log->external_path, $zipPath);
            } else {
                return ['success' => false, 'error' => 'Backup ZIP file does not exist on the server.'];
            }
        }

        // 1. CREATE SAFETY BACKUP OF THE CURRENT STATE BEFORE OVERWRITING
        try {
            $safetyBackup = $this->run(false); // Trigger manual safety backup
            if (!$safetyBackup['success']) {
                return [
                    'success' => false,
                    'error' => 'Failed to create safety backup prior to restore: ' . $safetyBackup['error']
                ];
            }
            $safetyZipPath = storage_path('app/backups/' . $safetyBackup['filename']);
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'error' => 'Failed to create safety backup prior to restore: ' . $th->getMessage()
            ];
        }

        // 2. RUN RESTORE
        try {
            $this->executeRestoreFromZip($zipPath);

            return [
                'success' => true,
                'safety_backup' => $safetyBackup['filename'],
                'duration' => round(microtime(true) - $startTime, 2) . 's'
            ];
        } catch (\Throwable $restoreException) {
            Log::error("Restore failed: " . $restoreException->getMessage() . ". Attempting rollback to safety backup...");

            // 3. ATTEMPT ROLLBACK TO SAFETY BACKUP
            try {
                if (file_exists($safetyZipPath)) {
                    $this->executeRestoreFromZip($safetyZipPath);
                }
                $rollbackMsg = "Restore failed: {$restoreException->getMessage()}. Rollback to safety backup completed successfully.";
            } catch (\Throwable $rollbackException) {
                Log::critical("CRITICAL: Rollback to safety backup failed: " . $rollbackException->getMessage());
                $rollbackMsg = "Restore failed: {$restoreException->getMessage()}. CRITICAL: Rollback to safety backup also failed: {$rollbackException->getMessage()}. The safety backup is saved at: {$safetyZipPath}";
            }

            return [
                'success' => false,
                'error' => $rollbackMsg
            ];
        }
    }

    /**
     * Restore the system from an uploaded local ZIP file.
     *
     * @param string $uploadedFilePath The path to the uploaded temporary file
     * @return array
     */
    public function restoreFromFile(string $uploadedFilePath): array
    {
        $startTime = microtime(true);
        if (!file_exists($uploadedFilePath)) {
            return ['success' => false, 'error' => 'Uploaded file not found.'];
        }

        // 1. CREATE SAFETY BACKUP OF THE CURRENT STATE BEFORE OVERWRITING
        try {
            $safetyBackup = $this->run(false); // Trigger manual safety backup
            if (!$safetyBackup['success']) {
                return [
                    'success' => false,
                    'error' => 'Failed to create safety backup prior to restore: ' . $safetyBackup['error']
                ];
            }
            $safetyZipPath = storage_path('app/backups/' . $safetyBackup['filename']);
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'error' => 'Failed to create safety backup prior to restore: ' . $th->getMessage()
            ];
        }

        // 2. RUN RESTORE
        try {
            $this->executeRestoreFromZip($uploadedFilePath);

            return [
                'success' => true,
                'safety_backup' => $safetyBackup['filename'],
                'duration' => round(microtime(true) - $startTime, 2) . 's'
            ];
        } catch (\Throwable $restoreException) {
            Log::error("Restore from file failed: " . $restoreException->getMessage() . ". Attempting rollback to safety backup...");

            // 3. ATTEMPT ROLLBACK TO SAFETY BACKUP
            try {
                if (file_exists($safetyZipPath)) {
                    $this->executeRestoreFromZip($safetyZipPath);
                }
                $rollbackMsg = "Restore failed: {$restoreException->getMessage()}. Rollback to safety backup completed successfully.";
            } catch (\Throwable $rollbackException) {
                Log::critical("CRITICAL: Rollback to safety backup failed: " . $rollbackException->getMessage());
                $rollbackMsg = "Restore failed: {$restoreException->getMessage()}. CRITICAL: Rollback to safety backup also failed: {$rollbackException->getMessage()}. The safety backup is saved at: {$safetyZipPath}";
            }

            return [
                'success' => false,
                'error' => $rollbackMsg
            ];
        }
    }

    /**
     * Executes the unzip, database import, folder replacement, and migrations.
     *
     * @param string $zipPath
     * @throws \Exception
     */
    protected function executeRestoreFromZip(string $zipPath)
    {
        $tempExtractDir = storage_path('app/backups/temp_restore_extract');
        if (file_exists($tempExtractDir)) {
            $this->deleteDirectory($tempExtractDir);
        }
        mkdir($tempExtractDir, 0755, true);

        // Extract ZIP
        $zip = new ZipArchive();
        if ($zip->open($zipPath) !== true) {
            throw new \Exception("Failed to open backup ZIP archive.");
        }
        $zip->extractTo($tempExtractDir);
        $zip->close();

        // 1. DB RESTORE
        $sqlFile = $tempExtractDir . '/database_backup.sql';
        if (!file_exists($sqlFile)) {
            throw new \Exception("Invalid backup ZIP: database_backup.sql is missing.");
        }

        $sqlContent = file_get_contents($sqlFile);
        
        // Execute SQL import
        DB::unprepared($sqlContent);

        // 2. FILE DIRECTORIES RESTORE
        $uploadDirs = [
            'shops' => public_path('shops'),
            'jobs' => public_path('jobs'),
            'userImages' => public_path('userImages'),
        ];

        $backupDirs = [];
        try {
            foreach ($uploadDirs as $name => $targetPath) {
                $extractedSource = $tempExtractDir . '/uploads/' . $name;
                
                // Backup existing directories by renaming
                $bakPath = $targetPath . '_restore_bak';
                if (file_exists($targetPath)) {
                    if (!rename($targetPath, $bakPath)) {
                        throw new \Exception("Failed to create temporary backup of existing directory: {$name}");
                    }
                    $backupDirs[$name] = $bakPath;
                }

                // Place extracted folders into target path
                if (file_exists($extractedSource) && is_dir($extractedSource)) {
                    if (!$this->moveDirectory($extractedSource, $targetPath)) {
                        throw new \Exception("Failed to restore directory: {$name}");
                    }
                } else {
                    // If directory was not present in the backup, create an empty target directory
                    if (!file_exists($targetPath)) {
                        mkdir($targetPath, 0755, true);
                    }
                }
            }
        } catch (\Throwable $fileEx) {
            // Rollback directories on exception
            foreach ($backupDirs as $name => $bakPath) {
                $targetPath = $uploadDirs[$name];
                if (file_exists($targetPath)) {
                    $this->deleteDirectory($targetPath);
                }
                rename($bakPath, $targetPath);
            }
            throw $fileEx;
        }

        // Cleanup backup directories on success
        foreach ($backupDirs as $name => $bakPath) {
            $this->deleteDirectory($bakPath);
        }

        // Cleanup extracted files
        $this->deleteDirectory($tempExtractDir);

        // 3. RUN MIGRATIONS FOR APP UPDATE COMPATIBILITY
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    }

    /**
     * Recursively delete a directory.
     *
     * @param string $dir
     * @return bool
     */
    protected function deleteDirectory(string $dir): bool
    {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        return rmdir($dir);
    }

    /**
     * Move directory by renaming or fallback to copy+delete.
     *
     * @param string $src
     * @param string $dst
     * @return bool
     */
    protected function moveDirectory(string $src, string $dst): bool
    {
        if (file_exists($dst)) {
            $this->deleteDirectory($dst);
        }
        if (rename($src, $dst)) {
            return true;
        }
        if ($this->copyDirectory($src, $dst)) {
            $this->deleteDirectory($src);
            return true;
        }
        return false;
    }

    /**
     * Recursively copy a directory.
     *
     * @param string $src
     * @param string $dst
     * @return bool
     */
    protected function copyDirectory(string $src, string $dst): bool
    {
        if (is_dir($src)) {
            if (!file_exists($dst)) {
                mkdir($dst, 0755, true);
            }
            $files = scandir($src);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    if (!$this->copyDirectory("$src/$file", "$dst/$file")) {
                        return false;
                    }
                }
            }
            return true;
        } elseif (file_exists($src)) {
            return copy($src, $dst);
        }
        return false;
    }
}

