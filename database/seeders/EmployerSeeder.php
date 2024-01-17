<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeePayroll;
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
            Employee::factory(2)->create([
                'employer_id' => $employer->id
            ]);

            $months = 4;
            $baseDate = now()->subMonths($months)->startOfMonth()->toImmutable();
            for ($i = 1; $i <= $months * 2; $i++) {

                $i % 2 === 0 ? $lastFortnight = true : $lastFortnight = false;

                if ( ! $lastFortnight) {
                    $startPeriod = $baseDate->addMonths(floor(($i-1)/2))->startOfMonth()->toImmutable();
                    $endPeriod = $startPeriod->addDays(14);
                }
                else {
                    $startPeriod = $baseDate->addMonths(floor(($i-1)/2))->startOfMonth()->addDays(15)->toImmutable();
                    $endPeriod = $startPeriod->endOfMonth();
                }

                $payroll = new Payroll();
                $payroll->employer_id = $employer->id;
                $payroll->start_period = $startPeriod;
                $payroll->end_period = $endPeriod;
                $payroll->save();

                $employees = Employee::all();

                foreach ($employees as $employee) {
                    $ep = new EmployeePayroll();
                    $ep->payroll_id = $payroll->id;
                    $ep->employee_id = $employee->id;
                    $ep->worked_days = $startPeriod->diffInDays($endPeriod) + 1;
                    $ep->daily_salary = $employee->daily_salary;
                    $ep->integrated_salary = $employee->integrated_salary;
                    $ep->total_before_other_income = $ep->worked_days * $ep->daily_salary;
                    $ep->other_income = 0;
                    $ep->total_income = $ep->total_before_other_income + $ep->other_income;

                    $ep->ispt = 0;
                    $ep->ss = 0;
                    $ep->other_outcome = 0;
                    $ep->total_outcome = $ep->ispt + $ep->ss + $ep->other_outcome;

                    $ep->amount_to_pay = $ep->total_income - $ep->total_outcome;
                    $ep->amount_to_transfer = $ep->total_income - $ep->total_outcome - $ep->other_income;
                    $ep->amount_to_other_income= $ep->other_income;

                    $ep->save();
                }
            }

        });
    }
}
