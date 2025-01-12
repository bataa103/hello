<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enum\ExpenseType;

class Expense extends Model
{
    protected $fillable = [
        'type',
        'amount',
        'credit_id',
        'description',
    ];

    protected $casts = [
        'type' => ExpenseType::class,
    ];

    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }
}
