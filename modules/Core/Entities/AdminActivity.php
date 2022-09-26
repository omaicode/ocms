<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class AdminActivity extends Model
{
    protected $fillable = [
        'admin_id',
        'action',
        'agent'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];
}
