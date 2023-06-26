<?php

namespace Tests\Browser;

use App\Models\Competition;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class GeneralTest extends DuskTestCase
{
//    public function test_redirection_after_creating_competition()
//    {
//        $user = User::factory()->create();
//
//        $competition = Competition::factory()->create([
//            'owner_id' => $user->id,
//            'start_date' => today(),
//            'end_date' => today()->addDays(5)
//        ]);
//
//        $competition->users()->attach($user);
//
//        $this->browse(function (Browser $browser) use ($user, $competition) {
//            $browser->loginAs($user)
//                ->visit('/competition')
//                ->visit('/competition/create')
//                ->type('title', 'Test')
//                ->type('description', 'test')
//                ->type('start_date', '01-09-2023')
//                ->type('thumbnail_url', 'https://e7.pngegg.com/pngimages/935/770/png-clipart-pizza-pizza.png')
//                ->select('publication_status', 'gepubliceerd')
//                ->press('Aanmaken')
//                ->screenshot('tttt')
//                ->assertSee('Test');
//        });
//    }


//    public function test_choose_winner_text_is_shown()
//    {
//        $user = User::factory()->create();
//
//        $competition = Competition::factory()->create([
//            'owner_id' => $user->id,
//            'start_date' => today(),
//            'end_date' => today()->addDays(5)
//        ]);
//
//        $competition->users()->attach($user);
//
//        $this->browse(function (Browser $browser) use ($user, $competition) {
//            $browser->loginAs($user)
//                ->visit('/competition')
//                ->visit('/competition/create')
//                ->type('title', 'Test12345')
//                ->type('description', 'test')
//                ->type('start_date', '01-09-2023')
//                ->type('thumbnail_url', 'https://e7.pngegg.com/pngimages/935/770/png-clipart-pizza-pizza.png')
//                ->select('publication_status', 'gepubliceerd')
//                ->press('Aanmaken')
//                ->assertSee('De competitie is nog bezig, dus je kunt op het moment geen winnaar kiezen. Wel kun je de inzendingen beoordelen.');
//        });
//    }


//    public function test_no_date_set_is_shown()
//    {
//        $user = User::factory()->create();
//
//        $competition = Competition::factory()->create([
//            'owner_id' => $user->id,
//            'start_date' => today(),
//            'end_date' => today()->addDays(5)
//        ]);
//
//        $competition->users()->attach($user);
//
//        $this->browse(function (Browser $browser) use ($user, $competition) {
//            $browser->loginAs($user)
//                ->visit('/competition')
//                ->visit('/competition/create')
//                ->type('title', 'Test12345')
//                ->type('description', 'test')
//                ->type('start_date', '01-09-2023')
//                ->type('thumbnail_url', 'https://e7.pngegg.com/pngimages/935/770/png-clipart-pizza-pizza.png')
//                ->select('publication_status', 'gepubliceerd')
//                ->press('Aanmaken')
//                ->visit('/competition')
//                ->assertSee('Geen einddatum opgegeven');
//        });
//    }


    public function test_user_is_redirected_after_joining()
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
                ->visit('/competition')
                ->visit('/competition/4')
                ->assertSee('Nationale Tuinontwerpwedstrijd');
        });
    }

    public function test_create_competition_via_navbar()
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
                ->visit('/competition')
                ->click('#create-competition')
                ->assertSee('Competitie aanmaken');
        });
    }


//    public function test_do_submission_via_detail_page()
//    {
//        $user = User::factory()->create();
//
//        $competition = Competition::factory()->create([
//            'owner_id' => $user->id,
//            'start_date' => today(),
//            'end_date' => today()->addDays(5)
//        ]);
//
//        $competition->users()->attach($user);
//
//        $this->browse(function (Browser $browser) use ($user, $competition) {
//            $browser->loginAs($user)
//                ->visit('/competition/joined')
//                ->visit('/competition/4')
//                ->visit('/competition/4/submission/create')
//                ->type('title', 'title')
//                ->type('description', 'description')
//                ->type('submission_url', 'https://e7.pngegg.com/pngimages/176/16/png-clipart-croquette-frikandel-pandesal-pizza-076-kaassouffle-bun-food-cheese-thumbnail.png')
//                ->press('Insturen')
//                ->assertSee('title');
//        });
//    }
}
