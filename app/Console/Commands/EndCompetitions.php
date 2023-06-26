<?php

namespace App\Console\Commands;

use App\Models\Competition;
use Illuminate\Console\Command;

class EndCompetitions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:end-competitions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks which competitions have end dates before the current date and sets their ended field to true';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            // This code purposefully uses == instead of <, so if users decide to restart their competition after an end date, it doesn't get set back to ended the next day.
            Competition::whereDate('end_date', '==', now()->subDay()->toDateString())->update(['ended' => true]);
            $this->info('Successfully updated ended field for competitions.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

    }
}
