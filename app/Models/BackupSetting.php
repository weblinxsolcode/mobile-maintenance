<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackupSetting extends Model
{
    protected $table = 'backup_settings';

    protected $fillable = [
        'shop_id',
        'auto_backup',
        'external_path',
        'retention_days',
        'last_backup_at',
    ];

    protected $casts = [
        'auto_backup' => 'boolean',
        'retention_days' => 'integer',
        'last_backup_at' => 'datetime',
    ];
}
