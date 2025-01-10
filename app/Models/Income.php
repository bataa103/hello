<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'income';

    protected $fillable = [
        'user_id',
        'source',
        'amount',
        'date',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getAmountAttribute($value)
    {
        return number_format($value, 2);
    }


    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = (float) $value;
    }


    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
