<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * 
     * Define the model's default state.
     * 
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $carBrands = ['Toyota', 'Honda', 'Ford', 'Chevrolet'];
        $carModels = ['Camry', 'Civic', 'Fiesta', 'Spark'];
        $locations = ['Makati', 'Quezon City', 'Pasay', 'Pasig'];
        $rentalFees = [2000, 3000, 4000, 5000];

        return [
            'display_picture' => Storage::url('dp/' . $this->faker->image('public/storage/dp', 640, 480, null, false)),
            'car_brand' => $this->faker->randomElement($carBrands),
            'car_model' => $this->faker->randomElement($carModels),
            'year' => $this->faker->year($max = 'now'),
            'seats' => $this->faker->numberBetween($min = 2, $max = 8),
            'plate_number' => $this->faker->unique()->regexify('[A-Z]{3}-[0-9]{3}'),
            'vehicle_identification_number' => $this->faker->unique()->regexify('[A-Z0-9]{17}'),
            'location' => $this->faker->randomElement($locations),
            'certificate_of_registration' => 'public/storage/cor/dummy-certificate-of-registration.pdf',
            'car_description' => $this->faker->sentence(10),
            'rental_fee' => $this->faker->randomElement($rentalFees),
            'add_picture1' => Storage::url('car_images/' . $this->faker->image('public/storage/car_images', 640, 480, null, false)),
            'add_picture2' => Storage::url('car_images/' . $this->faker->image('public/storage/car_images', 640, 480, null, false)),
            'add_picture3' => Storage::url('car_images/' . $this->faker->image('public/storage/car_images', 640, 480, null, false)),
            'status' => 'available',
        ];
    }
}