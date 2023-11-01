<?php

namespace Database\Seeders;

use App\Models\ServiceListing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceListingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceListing::factory()->count(10)->create();
    }
}
