<?php

namespace Tests\Browser;

use App\Models\Competition;
use App\Models\Enums\CompetitionPublicationStatus;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CompetitionPermissionsTest extends DuskTestCase
{

//    public function test_registered_user_can_participate(): void
//    {
//
//        $this->browse(function (Browser $browser) {
//            $browser->loginAs(User::find(2));
//            $browser->visit('/competition/1');
//            $browser->assertSee('Deelnemen');
//            $browser->clickLink("Deelnemen", 'a.btn.btn-primary.align-self-start');
//            $browser->assertPathIs('/competition/1');
//            $browser->assertSee('Succesvol deelgenomen!');
//        });
//    }


    public function test_registered_user_cannot_access_concept_competition(): void
    {
        $this->browse(function (Browser $browser) {
            $conceptCompetition = Competition::factory()->create([
                'publication_status' => CompetitionPublicationStatus::Draft->value,
                'owner_id' => 5,
                'start_date' => now()->subDays(1)
            ]);
            $browser->loginAs(User::find(1));
            $browser->visit("/competition/{$conceptCompetition->id}");
            $browser->assertSee('403');
        });
    }


    public function test_competition_owner_can_access_concept_competition(): void
    {
        $this->browse(function (Browser $browser) {
            $conceptCompetition = Competition::factory()->create([
                'publication_status' => CompetitionPublicationStatus::Draft->value,
                'owner_id' => 5,
                'start_date' => now()->subDays(1)
            ]);
            $browser->loginAs(User::find(5));
            $browser->visit("/competition/{$conceptCompetition->id}");
            $browser->assertSee($conceptCompetition->title);
            $browser->assertSee('Bewerken');
        });
    }


    public function test_competition_participant_can_access_concept_competition(): void
    {
        $this->browse(function (Browser $browser) {
            $conceptCompetition = Competition::factory()->create([
                'publication_status' => CompetitionPublicationStatus::Draft->value,
                'owner_id' => 5,
                'start_date' => now()->subDays(1)
            ]);
            $conceptCompetition->users()->attach(1);
            $browser->loginAs(User::find(1));
            $browser->visit("/competition/{$conceptCompetition->id}");
            $browser->assertSee($conceptCompetition->title);
        });
    }
}
