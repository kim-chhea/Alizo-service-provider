<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orderService extends Model
{
    //
    protected $fillable = ['order_id', 'service_id', 'total_amount'];
    protected $hidden = ['created_at', 'updated_at'];
}
