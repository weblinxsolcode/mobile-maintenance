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
        'content_type',
        'status',
        'error_message',
    ];

    public function isDbOnly(): bool
    {
        return $this->content_type === 'db';
    }

    public function isFull(): bool
    {
        return $this->content_type === 'full';
    }
}
