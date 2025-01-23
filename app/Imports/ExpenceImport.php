<?php

namespace App\Imports;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExpenseImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Check if the amount in 'E' is less than 0 (Expense)
        if ((float) $row['e'] < 0) {
            return new Expense([
                'amount' => abs((float) str_replace(',', '', $row['e'])), // Convert negative amount to positive
                'description' => $row['g'] ?? '', // Description from row['G']
                'date' => \Carbon\Carbon::parse($row['a'])->format('Y-m-d'), // Date from row['A']
                'user_id' => Auth::id(), // Authenticated user ID
            ]);
        }

        // Skip rows that don't meet the condition
        return null;
    }
}
