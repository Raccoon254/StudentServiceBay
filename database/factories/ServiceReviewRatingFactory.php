<?php

namespace Database\Factories;

use App\Models\ServiceProvider;
use App\Models\ServiceReviewRating;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/**
 * @extends Factory<ServiceReviewRating>
 */
class ServiceReviewRatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = new Faker();
        return [
            'user_id' => function() {
                return User::inRandomOrder()->first()->id;
            },
            'service_provider_id' => function() {
                return ServiceProvider::inRandomOrder()->first()->id;
            },
            'rating' => $this->faker->numberBetween(1, 5),
            'comments' => $this->faker->sentence,
            'date_reviewed' => $this->faker->dateTime(),
        ];
    }
}
