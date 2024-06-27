<?php

namespace App\Console\Commands;

use App\Models\Jobs;
use Illuminate\Console\Command;

class CheckAndCloseExpiredJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:check-deadline';


    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Check for deadline of jobs listings and updated them respectively';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Jobs::whereDate('deadline', '<', now())->where('status', '!=', 'closed')->update(['status' => 'closed']);
    }
}
