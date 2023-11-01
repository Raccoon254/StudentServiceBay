<?php

namespace Database\Factories;

use App\Models\ScamAlert;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'users' => function() {
                return User::inRandomOrder()->first()->id;
            },
            'alert_id' => function() {
                return ScamAlert::inRandomOrder()->first()->id;
            },
            'content' => $this->faker->sentence,
        ];
    }
}
