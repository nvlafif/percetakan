<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_month',
        'period_year',
        'total_base_salary',
        'total_allowances',
        'total_deductions',
        'total_net_salary',
        'status',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'total_base_salary' => 'decimal:2',
        'total_allowances' => 'decimal:2',
        'total_deductions' => 'decimal:2',
        'total_net_salary' => 'decimal:2',
    ];

    public static function getPeriodOptions(): array
    {
        return [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
    }
}