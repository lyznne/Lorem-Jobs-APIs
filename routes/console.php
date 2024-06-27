<?php

use App\Models\Jobs;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('jobs:check-deadline', function () {
    Jobs::whereDate('deadline', '<', now())->where('status', '!=', 'closed')->update(['status' => 'closed']);
})->purpose('Check for deadline of jobs listings and updated them respectively')->daily();


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


