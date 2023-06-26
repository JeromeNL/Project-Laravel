<?php

namespace Tests\Browser;

use App\Models\Competition;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StopCompetitionTest extends DuskTestCase
{
    public function test_competition_owner_can_see_stop_button_if_competition_not_ended()
    {
        $user = User::factory()->create();

        $competition = Competition::factory()->create([
            'owner_id' => $user->id,
            'start_date' => today(),
            'end_date' => today()->addDays(5)
        ]);

        $competition->users()->attach($user);

        $this->browse(function (Browser $browser) use ($user, $competition) {
            $browser->loginAs($user)
                ->visit('/competition/' . $competition->id)
                ->assertSee('Stop competitie');
        });
    }


    public function test_competition_owner_can_see_resume_button_if_competition_ended()
    {
        $user = User::factory()->create();
        $competition = Competition::factory()->create([
            'owner_id' => $user->id,
            'ended' => true,
        ]);

        $this->browse(function (Browser $browser) use ($user, $competition) {
            $browser->loginAs($user)
                ->visit('/competition/' . $competition->id)
                ->assertSee('Hervat competitie');
        });
    }


    public function test_non_competition_owner_can_not_see_stop_button()
    {
        $user = User::factory()->create();
        $competitionOwner = User::factory()->create();

        $competition = Competition::factory()->create([
            'ended' => true,
            'owner_id' => $competitionOwner->id,
        ]);
        $competition->users()->attach($user);

        $this->browse(function (Browser $browser) use ($user, $competition) {
            $browser->loginAs($user)
                ->visit('/competition/' . $competition->id)
                ->assertDontSee('Stop competitie');
        });
    }


    public function test_non_competition_owner_can_not_see_resume_button(): void
    {
        $user = User::factory()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $competitionOwner = User::factory()->create();

            $competition = Competition::factory()
                ->create([
                    'ended' => true,
                    'owner_id' => $competitionOwner->id
                ]);

            $competition->users()->attach($user);

            $browser->loginAs($user)
                ->visit('/competition/' . $competition->id)
                ->assertDontSee('Hervat competitie');
        });
    }


    public function test_stop_button_turns_to_resume_when_stopping_competition(): void
    {
        $user = User::factory()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $competition = Competition::factory()->create([
                'owner_id' => $user->id,
                'ended' => false
            ]);

            $browser->loginAs($user)
                ->visit(route('competition.show', ['competition' => $competition->id]))
                ->waitForText('Stop competitie')
                ->press('Stop competitie')
                ->waitForText('Hervat competitie')
                ->assertSee('Hervat competitie');
        });
    }


    public function test_resume_button_turns_to_stop_when_resuming_competition(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $browser->loginAs($user);

            $competition = Competition::factory()->create([
                'owner_id' => $user->id,
                'ended' => true
            ]);

            $browser->visit('/competition/' . $competition->id)
                ->assertSee('Hervat competitie')
                ->press('Hervat competitie')
                ->waitForText('Stop competitie')
                ->assertSee('Stop competitie');
        });
    }


    public function test_users_cannot_join_competitions_when_competition_has_ended(): void
    {
        $user = User::factory()->create();
        $competitionOwner = User::factory()->create();

        $competition = Competition::factory()->create([
            'owner_id' => $competitionOwner->id,
            'ended' => true
        ]);

        $this->browse(function (Browser $browser) use ($user, $competition) {
            $browser->loginAs($user)
                ->visit('/')
                ->assertSee($competition->title)
                ->assertSee('Afgelopen');
        });
    }


    public function test_users_cannot_submit_to_competition_when_competition_has_ended(): void
    {
        $user = User::factory()->create();
        $competitionOwner = User::factory()->create();



        $competition = Competition::factory()->create([
            'owner_id' => $competitionOwner->id,
            'ended' => true,
            'submissions_limit' => 5
        ]);

        $competition->users()->attach($user);

        $this->browse(function (Browser $browser) use ($user, $competition) {
            $browser->loginAs($user)
                ->visit('/competition/' . $competition->id . '/submission/create')
                ->assertSee('Afgelopen');
        });
    }
}
