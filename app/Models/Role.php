<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    public function users()
    {
        return $this->belongsToMany(User::class,'user_role')->withTimestamps();
    }
}
