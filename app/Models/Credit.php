<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enum\Bank;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'bank',
        'IBAN',
        'thumbnail',
        'user_id'
    ];

    protected $casts = [
        'bank' => Bank::class,
    ];

    public function user()
    {
        return $this->belongsTo(Credit::class);
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

}
