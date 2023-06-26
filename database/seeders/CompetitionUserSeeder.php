<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompetitionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Competition $privateCompetition */
        $privateCompetition = Competition::factory()->create(['private' => true, 'title' => 'Tosti\'s die lijken op Jezus competitie', 'thumbnail_url' => 'https://media-cldnry.s-nbcnews.com/image/upload/t_fit-1240w,f_auto,q_auto:best/streams/2012/October/121012/1C4262433-jesus-app-grilledcheese.jpg', 'description' => 'Ik wil heel graag weten wie de beste tosti die lijkt op Jezus heeft. De winnaar krijgt een gesigneerde versie van de bijbel.', 'start_date' => today(), 'end_date' => today()->addDays(5)]);
        $privateCompetition->users()->syncWithoutDetaching(User::factory()->count(20)->create());
        $privateCompetition->submissions()->saveMany(Submission::factory()->count(6)->create(['competition_id' => $privateCompetition->id, 'title' => 'Jezus tosti', 'submission_url' => 'https://cdn.thisiswhyimbroke.com/images/grilled-jesus-sandwich-press-640x533.jpg', 'description' => 'Dit is echt net Jezus, maar dan op een tost']));

        for ($i = 0; $i < 20; $i++) {
            $competition = Competition::inRandomOrder()->first();
            $user = User::whereDoesntHave('competitions', function ($query) use ($competition) {
                $query->where('competition_id', $competition->id);
            })
                ->inRandomOrder()
                ->first();

            $competition->users()->syncWithoutDetaching($user->id);
        }
    }
}
