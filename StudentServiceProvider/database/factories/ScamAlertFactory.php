<?php

namespace Database\Factories;

use App\Models\ScamAlert;
use App\Models\ServiceProvider;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ScamAlert>
 */
class ScamAlertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_provider' => function() {
                return ServiceProvider::inRandomOrder()->first()->id;
            },
            'description' => $this->faker->sentence,
            'date_reported' => $this->faker->date(),
            'location_area' => $this->faker->city,
            'reported_by' => function() {
                return User::inRandomOrder()->first()->id;
            },
        ];
    }
}
