# setup-scheduler.ps1
# Run this script ONCE as Administrator to register Laravel's scheduler
# in Windows Task Scheduler. It will call `php artisan schedule:run`
# every minute, which allows the daily backup (and any other scheduled
# tasks) to fire at the correct time.

$projectPath = Split-Path -Parent $MyInvocation.MyCommand.Definition

# Resolve php.exe path
$phpPath = (Get-Command php -ErrorAction SilentlyContinue).Source
if (-not $phpPath) {
    Write-Error "php.exe not found in PATH. Please install PHP or add it to your PATH and re-run this script."
    exit 1
}

$artisanPath = Join-Path $projectPath "artisan"

$taskName    = "LaravelScheduler_MobileMaintenance"
$taskDesc    = "Runs Laravel Task Scheduler every minute for the Mobile Maintenance project. Required for automatic daily backups."

# Remove old task if exists
if (Get-ScheduledTask -TaskName $taskName -ErrorAction SilentlyContinue) {
    Unregister-ScheduledTask -TaskName $taskName -Confirm:$false
    Write-Host "Removed existing task: $taskName"
}

# Build the action
$action  = New-ScheduledTaskAction `
    -Execute $phpPath `
    -Argument "`"$artisanPath`" schedule:run" `
    -WorkingDirectory $projectPath

# Trigger: every 1 minute, indefinitely
$trigger = New-ScheduledTaskTrigger -RepetitionInterval (New-TimeSpan -Minutes 1) -Once -At (Get-Date)

# Settings
$settings = New-ScheduledTaskSettingsSet `
    -ExecutionTimeLimit (New-TimeSpan -Minutes 2) `
    -MultipleInstances IgnoreNew `
    -StartWhenAvailable

# Principal: run as current user
$principal = New-ScheduledTaskPrincipal `
    -UserId ([System.Security.Principal.WindowsIdentity]::GetCurrent().Name) `
    -LogonType S4U `
    -RunLevel Highest

# Register
Register-ScheduledTask `
    -TaskName  $taskName `
    -Action    $action `
    -Trigger   $trigger `
    -Settings  $settings `
    -Principal $principal `
    -Description $taskDesc `
    -Force

Write-Host ""
Write-Host "✅  Task '$taskName' registered successfully!"
Write-Host "    PHP  : $phpPath"
Write-Host "    Dir  : $projectPath"
Write-Host "    Runs : every 1 minute"
Write-Host ""
Write-Host "Daily automatic backup will now run at midnight (00:00)."
Write-Host "You can verify with: php artisan schedule:list"
