<?php

namespace Tests\Browser;

use App\Models\Competition;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class OwnedCompetitionIndexTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_owned_competitions_show_in_owned_index(): void
    {
        $user = User::factory()->create();
        $competition = Competition::factory()->for($user, 'user')->create();

        $this->browse(function (Browser $browser) use ($user, $competition) {
            $browser->visit('/')
                ->loginAs($user)
                ->visitRoute('competition.ownedIndex')
                ->assertSee($competition['title']);
        });
    }


    public function test_unowned_competitions_do_not_show_in_owned_index(): void
    {
        $user = User::factory()->create();
        $competition = Competition::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $competition) {
            $browser->visit('/')
                ->loginAs($user)
                ->visitRoute('competition.ownedIndex')
                ->assertDontSee($competition['title']);
        });
    }


//    public function test_cannot_access_owned_index_when_not_logged_in(): void
//    {
//        $this->browse(function (Browser $browser) {
//            $browser->visitRoute('competition.ownedIndex')
//                ->assertRouteIs('auth.login');
//        });
//    }
}
