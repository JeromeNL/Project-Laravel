<?php

namespace Tests\Browser;

use App\Models\Competition;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteSubmissionTest extends DuskTestCase
{
//    public function test_delete_submission(): void
//    {
//        $this->browse(function (Browser $browser) {
//            $browser->loginAs(User::find(1));
//            $competitionId = Competition::where('owner_id', 1)->first()->id;
//            $browser->visit("/competition/{$competitionId}");
//            $browser->click('[data-bs-target="#removeSubmissionModal"]');
//            $browser->screenshot('remove_submission_modal');
//            $browser->press('Definitief verwijderen');
//            $browser->assertPathIs('/competition/' . $competitionId);
//            $browser->assertSee('De inzending is succesvol verwijderd.');
//        });
//    }


    public function test_delete_submission_not_authorized(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3));
            $competitionId = Competition::where('owner_id', 1)->first()->id;
            $browser->visit("/competition/{$competitionId}");
            $browser->assertDontSee('[data-bs-target="#removeSubmissionModal"]');
            $browser->assertDontSee('Definitief verwijderen');
            $browser->assertMissing('.fa-trash');
        });
    }
}
