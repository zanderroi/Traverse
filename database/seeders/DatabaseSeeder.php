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
        User::create([
            'name' => 'Admin',
            'email' => 'traverseadmin@gmail.com',
            'password' => Hash::make('password'),
            'user_type' => 'admin',
            'address' => '',
            'phone_number' => '',
            'birthday' => '1995-01-01',
            'govtid' => '',
            'govtid_image' => '',
            'driverslicense' => '',
            'driverslicense_image' => '',
            'selfie_image' => '',
            'contactperson1' => '',
            'contactperson1number' => '',
            'contactperson2' => '',
            'contactperson2number' => '',
        ]);

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

        
        // User::factory()
        //     ->count(5)
        //     ->state(new Sequence(
        //         ['user_type' => 'car_owner'],
        //         ['user_type' => 'customer'],
        //     ))
        //     ->create([
        //         'password' => Hash::make('password'),
        //     ])
        //     ->each(function ($user) {
        //         // Generate cars for each car owner
        //         $user->cars()->saveMany(
        //             Car::factory()->count(1)->create([
        //                 'car_owner_id' => $user->id,
        //             ])
        //         );

        //     });
        // \App\Models\Cars::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

}
