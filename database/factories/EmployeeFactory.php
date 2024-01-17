<?php

namespace Database\Factories;

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
            'name' => $this->faker->name,
            'rfc' => $this->faker->uuid,
            'nss' => $this->faker->uuid,
            'start_date' => $this->faker->date('Y-m-d', now()->subDay()->toDateString()),
            'end_date' => null,

            'daily_salary' => $ds = $this->faker->randomFloat(2, 150, 1000),
            'integrated_salary' => $ds * 1.0493,

            'payment_type' => 'biweekly',
        ];
    }
}
