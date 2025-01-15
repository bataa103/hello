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
        'user_id',
    ];

    protected $casts = [
        'incomeType' => IncomeType::class,
    ];

    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
