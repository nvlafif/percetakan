<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
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
            'printing' => 'Printing',
            'photocopy' => 'Photocopy',
            'design' => 'Design',
            'other' => 'Other',
        ];
    }
}