<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => Employer::inRandomOrder()->first()->id,
            'name' => $this->faker->name,
            'nss' => $this->faker->uuid,
            'start_date' => $this->faker->date('Y-m-d', now()->subDay()->toDateString()),
            'daily_salary' => $this->faker->randomFloat(2, 150, 1000),
            'payment_type' => $this->faker->randomElement(['weekly', 'biweekly'])
        ];
    }
}
