<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Chatify\Traits\ChatifyMessenger;
use App\Models\Avatar;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'address',
        'phone_number',
        'birthday',
        'govtid',
        'govtid_image',
        'driverslicense',
        'driverslicense_image',
        'driverslicense2_image',
        'selfie_image',
        'contactperson1',
        'contactperson1number',
        'contactperson2',
        'contactperson2number',
        'user_type',
        'remember_token',
        'account_status',
        'booking_status'
    ];

    protected $attributes = [
        'account_status' => 'Active', // set the default value of status to 'available'
        'booking_status' => 'Available',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function cars()
    {
        return $this->hasMany(Car::class, 'car_owner_id');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }
    public function avatar()
{
    return $this->hasOne(Avatar::class);
}

}
