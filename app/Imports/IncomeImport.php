<?php

namespace App\Imports;

use App\Models\Income;
use App\Models\Credit;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IncomeImport implements ToModel, WithHeadingRow
{
    /**
     * Map each row to a new Income model instance.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Find the credit by IBAN
        $credit = Credit::where('IBAN', $row['iban'])
            ->where('user_id', Auth::id()) // Ensure the credit belongs to the authenticated user
            ->first();

        // Handle the case where no matching credit is found
        if (!$credit) {
            return null; // Or handle this as needed, e.g., log an error
        }

        // Create a new Income record
        return new Income([
            'amount' => $row['amount'], // Use column name as per the header in Excel
            'description' => $row['description'],
            'date' => $row['date'], // Ensure the format in the Excel file matches
            'credit_id' => $credit->id, // Associate the income with the correct credit
            'user_id' => Auth::id(), // Associate the income with the authenticated user
        ]);
    }
}
