<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Booking;
use App\Models\CarLocation;


class Car extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'cars';
    protected $primaryKey = 'id';

    protected $fillable = [
        'display_picture',
        'car_brand',
        'car_model',
        'year',
        'seats',
        'plate_number',
        'vehicle_identification_number',
        'location',
        'certificate_of_registration',
        'car_description',
        'rental_fee',
        'add_picture1',
        'add_picture2',
        'add_picture3',
        'car_owner_id',
        'ratings',
        'status',
    ];

    
    protected $attributes = [
        'status' => 'available', // set the default value of status to 'available'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'car_owner_id');
    }

    public function carRatings()
    {
         return $this->hasMany(CarRating::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }   

    public function locations()
{
    return $this->hasMany(CarLocation::class);
}



}
