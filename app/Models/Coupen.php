<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupen extends Model
{
    protected $fillable = [
        'name',
        'code',
        'quantity',
        'max_use',
        'start_date',
        'end_date',
        'discount_type',
        'discount',
        'status',
        'total_used'
    ];
}
