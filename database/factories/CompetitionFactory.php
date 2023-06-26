<?php

namespace Database\Factories;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Competition::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_date = $this->faker->dateTimeBetween('now', '+2 months');
        $end_date = $this->faker->dateTimeBetween($start_date, '+6 months');

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'thumbnail_url' => $this->faker->imageUrl(),
            'publication_status' => 'Gepubliceerd',
            'owner_id' => 1,
        ];
    }
}
