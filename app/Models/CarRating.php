<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CarRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'rating',
        'car_id',
        'customer_id',
        'car_owner_id',
        'booking_id'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id')->select('id', 'first_name', 'last_name');
    }
    

    public function carOwner()
    {
        return $this->belongsTo(User::class, 'car_owner_id');
    }
}
