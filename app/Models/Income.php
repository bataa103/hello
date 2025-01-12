<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enum\IncomeType;


class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'incomeType',
        'amount',
        'credit_id',
        'description',
    ];

    protected $casts = [
        'incomeType' => IncomeType::class,
    ];

    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }
}
