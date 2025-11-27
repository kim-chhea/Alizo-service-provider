<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['user_id','note','status'];
    public function services()
    {
        return $this->belongsToMany(Service::class , 'order_services')->withTimestamps();
    }
    public function payment()
    {
        return $this->hasOne(payment::class);
    }
}
