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
            $table->float('total_before_other_income');
            $table->float('other_income');
            $table->float('total_income');

            $table->float('ispt');
            $table->float('ss');
            $table->float('other_outcome');
            $table->float('total_outcome');

            $table->float('amount_to_pay');
            $table->float('amount_to_transfer');
            $table->float('amount_to_other_income');

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
