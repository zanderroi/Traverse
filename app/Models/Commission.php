<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    protected $table = 'commissions';

    // Define the relationships with other models
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
