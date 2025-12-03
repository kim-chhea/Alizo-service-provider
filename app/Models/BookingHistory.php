<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    protected $table = 'booking_history';
    
    protected $fillable = [
        'booking_id',
        'user_id',
        'transaction_uid',
        'status',
        'notes',
    ];
    
    protected $hidden = ['created_at', 'updated_at'];

    public function booking()
    {
        return $this->belongsTo(booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
