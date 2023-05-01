<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;
    use HasFactory;

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
        'status',
    ];

    
    protected $attributes = [
        'status' => 'available', // set the default value of status to 'available'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'car_owner_id');
    }

}
