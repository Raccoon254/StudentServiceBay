<?php

namespace Database\Factories;

use App\Models\ServiceListing;
use App\Models\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServiceListing>
 */
class ServiceListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_provider_id' => function() {
                return ServiceProvider::inRandomOrder()->first()->id;
            },
            'service_description' => "This is a service description",
            'service_price' => $this->faker->randomFloat(2, 0, 100000),

        ];
    }
}
