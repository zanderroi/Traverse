<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Car;
use App\Models\Booking;

class TrackingData extends Model
{
    protected $fillable = [
        'car_id',
        'customer_id',
        'latitude',
        'longitude',
        'booking_id',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
