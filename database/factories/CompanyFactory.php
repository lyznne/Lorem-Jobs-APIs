<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'industry' => $this->faker->randomElement(['Technology', 'Finance', 'Healthcare']),
            'website' => $this->faker->url(),
            'about' => $this->faker->paragraph(),
            'contact_info' => [
                'email' => $this->faker->safeEmail(),
                'phone' => $this->faker->phoneNumber(),
            ],
            'logo' => $this->faker->imageUrl(640, 480, 'business'),
        ];
    }
}
