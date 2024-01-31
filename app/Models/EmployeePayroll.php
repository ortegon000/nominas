<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmployeePayroll extends Model
{
    use HasFactory;

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function payroll(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(EmployeeIncomes::class);
    }

    public function outcomes(): HasMany
    {
        return $this->hasMany(EmployeeOutcomes::class);
    }

    public function getTotalIncomeAttribute()
    {
        return $this->incomes->sum('amount') + $this->total_salary;

    }

    public function getTotalOutcomeAttribute()
    {
        return $this->outcomes->sum('amount');
    }
}
