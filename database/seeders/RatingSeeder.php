<?php

namespace Database\Seeders;

use App\Models\Rating;
use Database\Factories\RatingFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rating::factory(10)->create();
    }
}
