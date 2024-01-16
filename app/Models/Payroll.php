<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payroll extends Model
{
    use HasFactory;

    public function Employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function employeePayroll(): HasMany
    {
        return $this->hasMany(EmployeePayroll::class);
    }
}
