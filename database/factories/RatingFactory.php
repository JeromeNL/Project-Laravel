<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $comments = ['Mooie foto!', 'Leuk gedaan!', 'In deze foto heb je volgens mij echt veel werk gestoken.', 'Ik vind deze foto niet zo mooi.', 'Heel gaaf!'];
        return [
            'rating' => fake()->numberBetween(1, 5),
            'comment' => $comments[fake()->numberBetween(0, 4)],
            'created_at' => now(),
            'submission_id' => fake()->numberBetween(1, 10),
            'user_id' => fake()->numberBetween(1, 6),
        ];
    }
}
