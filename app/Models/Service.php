<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable = ['title' ,'description', 'price','image'];
    public function orders()
    {
        return $this->belongsToMany(Order::class , 'order_services')->withTimestamps();
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class,'service_categories')->withTimestamps();
    }
    public function wishlists()
    {
        return $this->belongsToMany(Wishlist::class, 'wishlist_services');
    }
    
    public function bookings()
    {
        return $this->belongsToMany(booking::class,'booking_items')->withTimestamps()->withPivot(['booking_date', 'time_slot', 'status']);

    }
    public function carts()
    {
        return $this->belongsToMany(cart::class,'cart_items')->withTimestamps()->withPivot('quantity');
    }
    public function reviews()
    {
        return $this->hasMany(review::class);
    }

}
