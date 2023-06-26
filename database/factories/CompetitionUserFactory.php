<?php

namespace Database\Factories;

use App\Models\Competition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompetitionUser>
 */
class CompetitionUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $competition = Competition::inRandomOrder()->first();
        $user = User::whereDoesntHave('competitions', function ($query) use ($competition) {
            return $query->where('competition_id', $competition->id);
        })->inRandomOrder()->first();
        return [
            'created_at' => now(),
            'competition_id' => $competition->id,
            'user_id' => $user->id,
            'submissions_limit' => fake()->numberBetween(3, 10),
        ];
    }
}
