<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enum\ExpenseType;

class Expense extends Model
{
    protected $fillable = [
        'id',
        'bank',
        'IBAN',
        'thumbnail',
        'balance',
    ];

    protected $casts = [
        'bank' => Bank::class,
    ];
}
