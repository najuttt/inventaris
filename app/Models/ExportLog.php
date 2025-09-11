<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportLog extends Model
{
    protected $fillable = [
        'admin_id',
        'type',
        'file_path',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}