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
        Schema::create('employee_incomes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_payroll_id')->constrained('employee_payrolls');
            $table->foreignId('employee_id')->constrained('employees');

            $table->string('name');
            $table->float('amount');
            $table->boolean('to_transfer')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_incomes');
    }
};
