<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeIncomes;
use App\Models\EmployeeIncomeTemplate;
use App\Models\EmployeeOutcomes;
use App\Models\EmployeeOutcomeTemplate;
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
                    $ep->total_salary = $ep->worked_days * $ep->daily_salary;

                    $ep->save();

                    $incomeTemplates = EmployeeIncomeTemplate::all();
                    $totalIncomes = 0;
                    foreach ($incomeTemplates as $template) {
                        $income = new EmployeeIncomes;
                        $income->employee_payroll_id = $ep->id;
                        $income->employee_id = $employee->id;
                        $income->name = $template->name;
                        $income->amount = $ep->daily_salary * 2; // TODO correct amount or calc
                        $income->to_transfer = $template->to_transfer;
                        $totalIncomes += $income->amount;

                        $income->save();
                    }

                    $outcomeTemplates = EmployeeOutcomeTemplate::all();
                    $totalOutcomes = 0;
                    foreach ($outcomeTemplates as $template) {
                        $outcome = new EmployeeOutcomes;
                        $outcome->employee_payroll_id = $ep->id;
                        $outcome->employee_id = $employee->id;
                        $outcome->name = $template->name;
                        $outcome->amount = $ep->daily_salary / 2; // TODO correct amount or calc

                        $totalOutcomes =+ $outcome->amount;

                        $outcome->save();
                    }

                    $ep->total_income = $totalIncomes + $ep->total_salary;
                    $ep->total_outcome = $totalOutcomes;

                    $total_to_transfer = $ep->incomes->where('to_transfer', true)->sum('amount');
                    $ep->amount_to_pay = $ep->total_income - $ep->total_outcome;
                    $ep->amount_to_transfer = $ep->amount_to_pay - $total_to_transfer;
                    $ep->amount_to_other_income = $total_to_transfer;

                    $ep->save();
                }
            }

        });
    }
}
