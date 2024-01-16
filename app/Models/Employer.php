<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employer extends Model
{
    use HasFactory;

    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function payroll(): HasMany
    {
        return $this->hasMany(Payroll::class);
    }
}
