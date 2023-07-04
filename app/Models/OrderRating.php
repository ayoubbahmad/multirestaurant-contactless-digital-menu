<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderRating extends Model
{
    protected $fillable = [
        'order_id',
        'store_id',
        'rating',
        'comments',
    ];
}
