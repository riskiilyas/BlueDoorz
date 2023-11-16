<?php

namespace App\Console\Commands;

use App\Jobs\CheckReservationDate;
use Illuminate\Console\Command;

class RunCheckReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:check-reservation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking check-out dates');
        CheckReservationDate::dispatch();
        $this->info('Job dispatched successfully!');
    }
    
}
