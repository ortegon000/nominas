<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payroll extends Model
{
    use HasFactory;

    public function Employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function employeePayrolls(): HasMany
    {
        return $this->hasMany(EmployeePayroll::class);
    }

    public function incomes():HasManyThrough
    {
        return $this->hasManyThrough(EmployeeIncomes::class, EmployeePayroll::class);
    }

    public function outcomes():HasManyThrough
    {
        return $this->hasManyThrough(EmployeeOutcomes::class, EmployeePayroll::class);
    }
}
