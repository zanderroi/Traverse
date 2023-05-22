<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Avatar extends Model
{
    protected $fillable = ['user_id', 'avatar'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    
}
