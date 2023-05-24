<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ProfilePicture extends Model
{
    protected $fillable = ['user_id', 'profilepicture'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    
}
