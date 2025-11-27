<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cartService extends Model
{
    protected $table = 'cart_items';
    protected $fillable = ['cart_id', 'service_id', 'quantity', 'total_price'];
}
