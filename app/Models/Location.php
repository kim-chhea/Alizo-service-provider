<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $fillable = ['user_id','address' ,'city' ,'country','postal_code','country_code'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
