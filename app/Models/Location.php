<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $fillable = ['user_id','address' ,'city' ,'country','postal_code','country_code'];
    protected $hidden = ['created_at', 'updated_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
