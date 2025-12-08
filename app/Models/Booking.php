<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Testing\FileFactory;
// use Symfony\Component\HttpFoundation\FileBag;

class booking extends Model
{
    // 
    protected $fillable = ['user_id', 'note', 'scheduled', 'is_confirmed'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function services()
    {
        return $this->belongsToMany(Service::class,'booking_items')->withTimestamps();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function payment()
    {
        return $this->hasOne(payment::class);
    }
}
