<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $admins = [
        [
            'first_name' => 'Admin',
            'last_name' => 'Nel',
            'email' => 'admin1@traverse.com',
        ],
        [
            'first_name' => 'Admin',
            'last_name' => 'Zander',
            'email' => 'admin2@traverse.com',
        ],
        [
            'first_name' => 'Admin',
            'last_name' => 'Czyrill',
            'email' => 'admin3@traverse.com',
        ],
        [
            'first_name' => 'Admin',
            'last_name' => 'Ian',
            'email' => 'admin4@traverse.com',
        ],
    ];

<<<<<<< HEAD
//         $carOwners = User::factory()
//             ->count(10)
//             ->state(new Sequence(
//                 ['user_type' => 'car_owner'],
//                 ['user_type' => 'customer'],
//             ))
//             ->create([
//                 'password' => Hash::make('password'),
//             ]);

//         $carOwners->each(function ($owner) {
//             if ($owner->user_type === 'car_owner') {
//             $cars = Car::factory()->count(2)->make();
//             $owner->cars()->saveMany($cars);
//             }
//         });
=======
    foreach ($admins as $admin) {
        User::firstOrCreate(
            ['email' => $admin['email']],
            array_merge($admin, [
                'password' => Hash::make('password'),
                'user_type' => 'admin',
                'address' => '',
                'phone_number' => '',
                'birthday' => '1995-01-01',
                'govtid' => '',
                'govtid_image' => '',
                'driverslicense' => '',
                'driverslicense_image' => '',
                'driverslicense2_image' => '',
                'selfie_image' => '',
                'contactperson1' => '',
                'contactperson1number' => '',
                'contactperson2' => '',
                'contactperson2number' => '',
            ])
        );
    }
                $carOwners = User::factory()
                ->count(10)
                ->state(new Sequence(
                    ['user_type' => 'car_owner'],
                    ['user_type' => 'customer'],
                ))
                ->create([
                    'password' => Hash::make('password'),
                ]);

            $carOwners->each(function ($owner) {
                if ($owner->user_type === 'car_owner') {
                $cars = Car::factory()->count(2)->make();
                $owner->cars()->saveMany($cars);
                }
            });
>>>>>>> e36366c05e4ed3e71fb502348c47b57ecd460662

    }
}
