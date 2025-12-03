<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class serviceCategories extends Model
{
    protected $table = 'service_categories';
    protected $fillable = ['category_id', 'service_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
