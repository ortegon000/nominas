<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Employer;
use App\Models\Payroll;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employer::factory(1)->create()->each(function ($employer) {
            Employee::factory(10)->create([
                'employer_id' => $employer->id
            ]);

            $weeks = 4;
            for ($i = 0; $i < $weeks; $i++) {

                $startPeriod = now()->subMonths(6)->startOfMonth()->addWeeks($i);
                $endPeriod = $startPeriod->copy()->addWeeks();

                $payroll = new Payroll();
                $payroll->employer_id = $employer->id;
                $payroll->start_period = $startPeriod;
                $payroll->end_period = $endPeriod;
                $payroll->save();
            }

        });
    }
}
