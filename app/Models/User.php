<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */ 
    protected $fillable = [
        'name',
        'gender',
        'first_name',
        'sure_name',
        'work_position',
        'email',
        'password',
    ];
    //relatioship of the user
    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_role')->withTimestamps();
    }
    public function location()
    {
        return $this->hasOne(Location::class);
    }
    public function reviews()
    {
        return $this->hasMany(review::class);
    }
       public function wishlist()
    {
        return $this->hasOne(Wishlist::class);
    }
    public function bookings()
    {
        return $this->hasMany(booking::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
