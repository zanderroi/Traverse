<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarData extends Model
{
    protected $table = 'car_data';
    protected $fillable = ['brand', 'model', 'type'];
}
