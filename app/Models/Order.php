<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'plan', 'amount', 'amount_value', 'status', 'source', 'address',
    ];
}
