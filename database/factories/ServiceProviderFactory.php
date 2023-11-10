<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceProvider>
 */
class ServiceProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'description' => $this->faker->paragraph,
            'email' => $this->faker->unique()->companyEmail,
            'contact_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'service_type' => $this->faker->word,
            'verification_status' => $this->faker->randomElement(['verified', 'unverified']),
            'profile_image' => $this->faker->randomElement(['a.jpg', 'b.jpg', 'c.jpg', 'd.jpg']),
        ];
    }
}
