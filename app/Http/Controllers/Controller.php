<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $casts = [
        'type' => ExpenseType::class,
    ];

    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }
}
