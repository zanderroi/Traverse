<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'name' => fake()->name(),
            // 'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'remember_token' => Str::random(10),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'birthday' => $this->faker->date(),
            'govtid' => $this->faker->uuid,
            'govtid_image' => $this->faker->imageUrl(),
            'driverslicense' => $this->faker->uuid,
            'driverslicense_image' => $this->faker->imageUrl(),
            'selfie_image' => $this->faker->imageUrl(),
            'contactperson1' => $this->faker->name,
            'contactperson1number' => $this->faker->phoneNumber,
            'contactperson2' => $this->faker->name,
            'contactperson2number' => $this->faker->phoneNumber,
            'user_type' => $this->faker->randomElement(['car_owner', 'customer']),
            'remember_token' => Str::random(10),
            'account_status' => 'Active',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}