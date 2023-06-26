<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Competition;

class FormTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */

//    public function test_user_submits_url_image()
//    {
//        $user = User::factory()->create();
//
//        $competition = Competition::factory()->create([
//            'owner_id' => $user->id,
//            'start_date' => today(),
//            'end_date' => today()->addDays(5)
//        ]);
//
//        $this->browse(function (Browser $browser ) use ($user, $competition) {
//            $browser->loginAs($user)
//                ->visit('/competition/' . $competition->id . '/submission/create')
//                ->type('title', 'Dit is een inzending')
//                ->type('submission_url', 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg')
//                ->assertSee('Jouw foto (url)')
//                ->assertDontSee('Jouw foto (bestand)')
//                ->press("Insturen")
//                ->assertPathIs('/competition/' . $competition->id);
//        });
//    }


//    public function test_required_submission_field_no_input()
//    {
//        $user = User::factory()->create();
//
//        $competition = Competition::factory()->create([
//            'owner_id' => $user->id,
//            'start_date' => today(),
//            'end_date' => today()->addDays(5)
//        ]);
//
//        $this->browse(function (Browser $browser ) use ($user, $competition) {
//            $browser->loginAs($user)
//                ->visit('/competition/' . $competition->id . '/submission/create')
//                ->type('submission_url', 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg')
//                ->press("Insturen")
//                ->assertPathIs('/competition/' . $competition->id . '/submission/create')
//                ->assertSee("Een titel is verplicht.");
//        });
//    }


//    public function test_create_competition_required_field_no_input()
//    {
//        $user = User::factory()->create();
//
//        $this->browse(function (Browser $browser ) use ($user) {
//            $browser->loginAs($user)
//                ->visit('/competition/create')
//                ->type('description', 'abcdefgh')
//                ->press("Aanmaken")
//                ->assertPathIs('/competition/create')
//                ->assertSee("Een titel is verplicht.")
//                ->assertSee("De startdatum is verplicht.");
//        });
//
//    }


//    public function test_create_competition_valid_input()
//    {
//        $user = User::factory()->create();
//
//        $this->browse(function (Browser $browser) use ($user) {
//            $browser->loginAs($user)
//                ->visit('/competition/create?')
//                ->type('title', 'Mijn competitie')
//                ->type('description', 'abcdefgh')
//                ->type('start_date', '2023-06-01')
//                ->press("Aanmaken")
//                ->assertDontSee("Een titel is verplicht.")
//                ->assertDontSee("De startdatum is verplicht.");
//
//        });
//    }
}
