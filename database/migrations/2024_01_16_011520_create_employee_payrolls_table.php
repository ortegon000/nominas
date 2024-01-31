<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_payrolls', function (Blueprint $table) {
            $table->id();

            $table->foreignId('payroll_id')->constrained('payrolls');
            $table->foreignId('employee_id')->constrained('employees');

            $table->integer('worked_days');
            $table->float('daily_salary');
            $table->float('integrated_salary');
            $table->float('total_salary');

            $table->float('total_income')->nullable();
            $table->float('total_outcome')->nullable();

            $table->float('amount_to_pay')->nullable();
            $table->float('amount_to_transfer')->nullable();
            $table->float('amount_to_other_income')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_payrolls');
    }
};
