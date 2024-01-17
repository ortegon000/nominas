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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employer_id')->constrained('employers');

            $table->string('name');
            $table->string('rfc');
            $table->string('nss');
            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->float('daily_salary');
            $table->float('integrated_salary');

            $table->enum('payment_type', [
                'weekly',
                'biweekly'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
