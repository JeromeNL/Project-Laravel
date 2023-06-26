<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateCompetitionTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
//    public function test_competition_owner_not_automatically_joined(): void
//    {
//        $user = User::factory()->create();
//
//        $this->browse(function (Browser $browser) use ($user) {
//            $browser->visit('/competition')
//                ->loginAs($user)
//                ->visit('/competition/create')
//                ->type( 'title', 'Dit is een testwedstrijd')
//                ->type( 'description', 'Dit is een testwedstrijd')
//                ->type( 'start_date', today()->format('m-d-Y'))
//                ->select(  'publication_status', 'Gepubliceerd')
//                ->press('Aanmaken')
//                ->assertSee('Test Competitie');
//        });
//    }
}
