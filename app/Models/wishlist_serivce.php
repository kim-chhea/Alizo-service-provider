<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wishlist_serivce extends Model
{
    protected $table = 'wishlist_services';
    protected $fillable = ['wishlist_id', 'service_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
