<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CompetitionSeeder::class,
            SubmissionSeeder::class,
            RatingSeeder::class,
            CompetitionUserSeeder::class,
        ]);

        User::factory()->hasAttached(Competition::find(1))->create([
            'email' => 'test@example.com'
        ]);

        Competition::where('id', 5)->update(['winning_submission_id' => 9]);

    }

}
