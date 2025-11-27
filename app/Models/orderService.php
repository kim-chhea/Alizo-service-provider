<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orderService extends Model
{
    //
    protected $fillable = ['order_id', 'service_id', 'total_amount'];
}
