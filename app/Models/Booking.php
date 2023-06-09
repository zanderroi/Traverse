<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'passengers',
        'pickup_date_time',
        'return_date_time',
        'returned_at',
        'total_rental_fee',
        'late_fee',
        'notes'
    ];

    protected $casts = [
        'pickup_date_time' => 'datetime',
        'return_date_time' => 'datetime',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
    return $this->belongsTo(User::class, 'user_id');
    }
    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }
    public function commission()
    {
        return $this->hasOne(Commission::class);
    }
    
    public function commissionSent()
    {
        return $this->commissions()->exists();
    }
    public function getCommissionAmount()
    {
        $commissionPercentage = 0.2; // 20% commission
        return $this->total_rental_fee * $commissionPercentage;
    }
    

    public function getLateFeeAttribute()
    {
        $returnDateTime = Carbon::parse($this->return_date_time);
        $dueDateTime = Carbon::parse($this->car->rental_due_time);
        $diffInHours = $returnDateTime->diffInHours($dueDateTime, false);
        $lateFee = max(0, $diffInHours) * 500;
        return $lateFee;
    }

    public function getTotalFeeAttribute()
    {
        $daysRented = $this->return_date_time->diffInDays($this->pickup_date_time);
        $totalRentalFee = $this->car->rental_fee * $daysRented;
        return $totalRentalFee + $this->late_fee;
    }
}
