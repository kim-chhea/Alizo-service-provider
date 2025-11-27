<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    //
    protected $fillable = [
        'order_id',
        'booking_id',
        'transaction_id',
        'discount_amount',
        'amount',
        'currency',
        'payment_method',
        'status',
    ];

    public function booking()
    {
        return $this->belongsTo(booking::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
