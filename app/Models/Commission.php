<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    protected $table = 'commissions';
    
    protected $fillable = [
        'booking_id',
        'car_owner_id',
        'total_rental_fee',
        'commission_amount',
        'receipt',
    ];
    // Define the relationships with other models
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

}
