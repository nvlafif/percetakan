<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'description',
        'amount',
        'date',
        'reference',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    public static function getCategoryOptions(): array
    {
        return [
            'supplies' => 'Supplies',
            'utility' => 'Utility',
            'rent' => 'Rent',
            'salary' => 'Salary',
            'maintenance' => 'Maintenance',
            'other' => 'Other',
        ];
    }
}