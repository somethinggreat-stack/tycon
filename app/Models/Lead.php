<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'source', 'interest', 'message', 'profile',
    ];

    protected $casts = [
        'profile' => 'array',
    ];
}
