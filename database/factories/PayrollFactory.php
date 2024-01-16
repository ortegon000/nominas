<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payroll>
 */
class PayrollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = now()->subMonths(rand(1,6))->startOfMonth()->addWeeks(rand(0,3));
        $endDate   = $startDate->copy()->addWeek();

        return [
            'start_period' => $startDate,
            'end_period' => $endDate,
        ];
    }
}
