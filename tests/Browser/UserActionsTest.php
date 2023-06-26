<?php

namespace Tests\Browser;

use App\Models\Competition;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class UserActionsTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function test_user_create_submission_unjoined_competition()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $competition = Competition::factory()->create([
            'owner_id' => $user2->id,
            'start_date' => today(),
            'end_date' => today()->addDays(5)
        ]);

        $this->browse(function (Browser $browser ) use ($user, $competition) {
            $browser->loginAs($user)
                ->visit('/competition/' . $competition->id . '/submission/create')
                ->assertSee("403");
        });
    }


    public function test_user_rate_button_not_shown_on_unjoined_competition()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $competition = Competition::factory()->create([
            'owner_id' => $user2->id,
            'start_date' => today(),
            'end_date' => today()->addDays(5)
        ]);

        $this->browse(function (Browser $browser ) use ($user, $competition) {
            $browser->loginAs($user)
                ->visit('/competition/' . $competition->id . '/')
                ->assertDontSee("Beoordeel");
        });
    }
}
