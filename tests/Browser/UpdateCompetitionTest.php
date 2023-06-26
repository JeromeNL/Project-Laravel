<?php

namespace Tests\Browser;

use App\Models\Competition;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpdateCompetitionTest extends DuskTestCase
{
    public function testTitleCorrect(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $competitionId = Competition::where('owner_id', 1)->first()->id;
            $browser->visit("/competition/{$competitionId}/edit");
            $browser->type('title', 'Gouden beeldjes');
            $browser->press('Aanpassen');
            $browser->assertPathIs('/competition/' . $competitionId);
            $browser->assertSee('Gouden beeldjes');
        });
    }


    public function testTitleNoTitleEntered(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $competitionId = Competition::where('owner_id', 1)->first()->id;
            $browser->visit("/competition/{$competitionId}/edit");
            $browser->type('title', '');
            $browser->press('Aanpassen');
            $browser->assertPathIs('/competition/' . $competitionId . '/edit');
            $browser->assertSee('Een titel is verplicht.');
        });
    }


    public function testDescription(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $competitionId = Competition::where('owner_id', 1)->first()->id;
            $browser->visit("/competition/{$competitionId}/edit");
            $browser->type('description', 'Dit is een test');
            $browser->press('Aanpassen');
            $browser->assertPathIs('/competition/' . $competitionId);
            $browser->assertSee('Dit is een test');
        });
    }


    public function testStartDate(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $competition = Competition::where('owner_id', 1)->first();
            $browser->visit("/competition/{$competition->id}/edit");
            $nextDay = Carbon::parse($competition->start_date)->addDay()->format('d-m-Y');
            $browser->type('start_date', $nextDay);
            $browser->press('Aanpassen');
            $browser->assertPathIs('/competition/' . $competition->id);
            $browser->assertSee($nextDay);
        });
    }


    public function testEndDateCorrect(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $competition = Competition::where('owner_id', 1)->first();
            $browser->visit("/competition/{$competition->id}/edit");
            $nextDay = Carbon::parse($competition->start_date)->addDays(20)->format('d-m-Y');
            $browser->type('end_date', $nextDay);
            $browser->press('Aanpassen');
            $browser->assertPathIs('/competition/' . $competition->id);
            $browser->assertSee($nextDay);
        });
    }


    public function testEndDateOngoing(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $competition = Competition::where('owner_id', 1)->first();
            $browser->visit("/competition/{$competition->id}/edit");
            $browser->type('end_date', '');
            $browser->press('Aanpassen');
            $browser->assertPathIs('/competition/' . $competition->id);
            $browser->assertSee('Geen einddatum opgegeven.');
        });
    }


    public function testEndDateBeforeStartDate(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $competition = Competition::where('owner_id', 1)->first();
            $browser->visit("/competition/{$competition->id}/edit");
            $incorrectEndDate = Carbon::parse($competition->start_date)->subDays(2)->format('d-m-Y');
            $browser->type('end_date', $incorrectEndDate);
            $browser->press('Aanpassen');
            $browser->assertPathIs('/competition/' . $competition->id . '/edit');
            $browser->assertSee('De einddatum moet na de startdatum zijn of leeg gelaten worden.');
        });
    }


    public function testThumbnailCorrect(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $competition = Competition::where('owner_id', 1)->first();
            $browser->visit("/competition/{$competition->id}/edit");
            $browser->type('thumbnail_url', 'https://i.imgur.com/r2LVGVR.jpg');
            $browser->press('Aanpassen');
            $browser->assertPathIs('/competition/' . $competition->id);
        });
    }


    public function testThumbnailIncorrect(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $competition = Competition::where('owner_id', 1)->first();
            $browser->visit("/competition/{$competition->id}/edit");
            $browser->type('thumbnail_url', 'test');
            $browser->press('Aanpassen');
            $browser->assertPathIs('/competition/' . $competition->id . '/edit');
            $browser->assertSee('De thumbnail moet een geldige url zijn.');
        });
    }
}
