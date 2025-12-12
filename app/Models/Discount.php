<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    //
    protected $fillable = [
        'title',
        'code',
        'descriptions',
        'percentage',
        'condition',
    ];
    protected $casts = [
        'condition' => 'array',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
}
