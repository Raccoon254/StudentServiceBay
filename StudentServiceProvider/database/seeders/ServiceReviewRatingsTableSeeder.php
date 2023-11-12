<?php

namespace Database\Seeders;

use App\Models\ServiceReviewRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceReviewRatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceReviewRating::factory()->count(10)->create();
    }
}
