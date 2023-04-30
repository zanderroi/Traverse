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
        
        User::factory()
            ->count(20)
            ->state(new Sequence(
                ['user_type' => 'car_owner'],
                ['user_type' => 'customer'],
            ))
            ->create([
                'password' => Hash::make('password'),
            ])
            ->each(function ($user) {
                // Generate cars for each car owner
                $user->cars()->saveMany(
                    Car::factory()->count(3)->create([
                        'car_owner_id' => $user->id,
                    ])
                );

            });
        // \App\Models\Cars::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
