<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\FeaturedJob;
use App\Models\Jobs;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Seed companies
        Company::factory(35)->create();

        // Seed jobs
        Jobs::factory(500)->create();

        // Create some featured jobs

        // Seed featured jobs
        $jobs = Jobs::inRandomOrder()->take(196)->get();

        foreach ($jobs as $job) {
            // Create a featured job for each selected job
            $featuredJob = FeaturedJob::create([
                'job_id' => $job->id,
                'is_featured'=> true,
            ]);
        }
    }
}
