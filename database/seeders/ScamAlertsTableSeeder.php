<?php

namespace Database\Seeders;

use App\Models\ScamAlert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScamAlertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScamAlert::factory()->count(10)->create();
    }
}
