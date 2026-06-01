<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackupLog extends Model
{
    protected $table = 'backup_logs';

    protected $fillable = [
        'filename',
        'path',
        'external_path',
        'size',
        'type',
        'status',
        'error_message',
    ];
}
