<?php

namespace App\Console;

use App\Console\Commands\CheckAndCloseExpiredJobs;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('jobs:check-deadline')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . "/Commands");

        //register jobs:check-update-jobs
        $this->commands([
            CheckAndCloseExpiredJobs::class,
        ]);

        // require the console routes
        require base_path("routes/console.php");
    }
}
