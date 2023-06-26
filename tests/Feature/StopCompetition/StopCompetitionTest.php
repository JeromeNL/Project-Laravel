<?php

namespace Tests\Feature\StopCompetition;

use App\Models\Competition;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class StopCompetitionTest extends TestCase
{
    use RefreshDatabase;


    /**
     * A basic feature test example.
     */
    public function test_competition_owner_can_see_stop_button_if_competition_not_ended(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $competition = Competition::factory()->create([
            'owner_id' => $user->id
        ]);

        $response = $this->get('/competition/' . $competition->id);

        $response->assertStatus(200);
        $response->assertSee('Stop competitie');
    }

    public function test_competition_owner_can_see_resume_button_if_competition_ended(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $competition = Competition::factory()->create([
            'owner_id' => $user->id,
            'ended' => true
        ]);

        $response = $this->get('/competition/' . $competition->id);

        $response->assertStatus(200);
        $response->assertSee('Hervat competitie');
    }

    public function test_non_competition_owner_can_not_see_stop_button(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $competitionOwner = User::factory()->create();

        $competition = Competition::factory()
            ->create([
                'ended' => true,
                'owner_id' => $competitionOwner->id
            ]);

        $competition->users()->attach($user);

        $response = $this->get('/competition/' . $competition->id);

        $response->assertStatus(200);
        $response->assertDontSee('Stop competitie');
    }

    public function test_non_competition_owner_can_not_see_resume_button(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $competitionOwner = User::factory()->create();

        $competition = Competition::factory()
            ->create([
                'ended' => true,
                'owner_id' => $competitionOwner->id
            ]);

        $competition->users()->attach($user);

        $response = $this->get('/competition/' . $competition->id);

        $response->assertStatus(200);
        $response->assertDontSee('Hervat competitie');
    }

    public function test_stop_button_turns_to_resume_when_stopping_competition(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $competition = Competition::factory()->create([
            'owner_id' => $user->id,
            'ended' => false
        ]);

        $response = $this->put(
            route('competition.toggleActive', ['competition' => $competition->id]),
            ['competition_id' => $competition->id]);

        $response = $this->followRedirects($response);

        $response->assertStatus(200);
        $response->assertSee('Hervat competitie');
    }

    public function test_resume_button_turns_to_stop_when_resuming_competition(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $competition = Competition::factory()->create([
            'owner_id' => $user->id,
            'ended' => true
        ]);

        $response = $this->put(
            route('competition.toggleActive', ['competition' => $competition->id]),
            ['competition_id' => $competition->id]);

        $response = $this->followRedirects($response);

        $response->assertStatus(200);
        $response->assertSee('Stop competitie');
    }

    public function test_users_cannot_join_competitions_when_competition_has_ended(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $competitionOwner = User::factory()->create();

        $competition = Competition::factory()->create([
            'owner_id' => $competitionOwner->id,
            'ended' => true
        ]);

        $response = $this->get('/');
        $response = $this->followRedirects($response);

        $response->assertStatus(200);
        $response->assertSee($competition->title);
        $response->assertSee('Afgelopen');
    }

    public function test_users_cannot_submit_to_competition_when_competition_has_ended(): void
    {
        {
            $user = User::factory()->create();
            Auth::login($user);

            $competitionOwner = User::factory()->create();

            $competition = Competition::factory()->create([
                'owner_id' => $competitionOwner->id,
                'ended' => true,
                'submissions_limit' => 5
            ]);

            $response = $this->get('/competition/' . $competition->id . '/submission/create');

            $response->assertStatus(200);
            $response->assertSee('Afgelopen');
        }

    }
}
