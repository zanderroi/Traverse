<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UnderEighteen implements Rule
{
    public function passes($attribute, $value)
    {
        // Calculate the age of the user based on their birthday
        $age = \Carbon\Carbon::parse($value)->age;

        // Check if the age is less than 18
        return $age >= 18;
    }

    public function message()
    {
        return 'You must be at least 18 years old to register.';
    }
}
