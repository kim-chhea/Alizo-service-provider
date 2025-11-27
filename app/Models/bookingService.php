<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bookingService extends Model
{
    protected $table = 'booking_items';
    protected $fillable = ['service_id', 'booking_id', 'discount_id', 'quantity', 'total_price', 'note', 'status'];
}
