<?php

namespace Database\Factories;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jobs>
 */
class JobsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $country = $this->faker->country();
        $city = $this->faker->city($country);

        return [
            'title' => $this->faker->jobTitle(),
            'location' => $country . ', ' . $city,
            // 'location' => $country =  $this->faker->country(). ', '. $this->faker->cityInCountry($country),
            'deadline' => Carbon::now()->addDays($this->faker->numberBetween(30, 365))->format('Y-m-d'),
            'posted_at' => Carbon::now()->subDays($this->faker->numberBetween(7, 365))->format('Y-m-d H:i:s'),
            'schedule' => $this->faker->randomElement(['part-time', 'full-time', 'remote']),
            'status' => $this->faker->randomElement(['active', 'closed', 'filled']),
            'description' => $this->faker->paragraph(),
            'salary' => $this->faker->randomFloat(2, 3000, 100000),
            // 'company_id' => Company::factory(),
            'company_id' => Company::inRandomOrder()->first()->id,
        ];
    }
}
