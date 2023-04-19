<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_brand',
        'car_model',
        'plate_number',
        'vehicle_identification_number',
        'location',
        'certificate_of_registration',
        'car_description',
        'rental_fee',
        'car_owner_id',
        'status',
    ];
    
    protected $attributes = [
        'status' => 'available', // set the default value of status to 'available'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'car_owner_id');
    }

    public function carImages()
    {
        return $this->hasMany(CarImage::class, 'car_id');
    }

}
