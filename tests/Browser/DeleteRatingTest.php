<?php

namespace Tests\Browser;

use App\Models\Competition;
use App\Models\Rating;
use App\Models\Submission;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteRatingTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_delete_rating_cannot_delete_rating_of_other_users(): void
    {
        $this->followRedirects = true;

        $user = User::factory()->create();
        $competition = Competition::factory()->for(User::factory(), 'user')->create();
        $submission = Submission::factory()->for($competition, 'competition')->for(User::factory(), 'user')->create();
        $rating = Rating::factory()->for($submission, 'submission')->for($user, 'user')->create(['comment' => 'Dit is een test']);

        for ($i = 0; $i < 5; $i++) {
            Rating::factory()->for($submission, 'submission')->for(User::factory(), 'user')->create();
        }

        $this->browse(function (Browser $browser) use ($competition, $submission, $rating, $user) {
            $browser->visit('/')
                ->loginAs($user)
                ->visitRoute('submissions.showRatingsForSubmission', $submission)
                ->assertSee($submission['title'])
                ->assertSee($rating['comment'])
                ->click('@openModal' . $rating['id'])
                ->waitFor('@deleteRating' . $rating['id'])
                ->press('@deleteRating' . $rating['id'])
                ->assertDontSee($rating['comment'])
                ->assertSee('Beoordeling succesvol verwijderd.')
                ->assertSee($submission['title'])
                ;
        });
    }
}
