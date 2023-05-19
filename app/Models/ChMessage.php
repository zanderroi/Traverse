<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;
use App\Models\User;

class ChMessage extends Model
{
    use UUID;
}
