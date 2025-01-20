<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Credit;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Carbon;
use App\Models\User;


class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        $userId = Auth::id();

        // Fetch credit data
        $credits = Credit::with('expenses', 'incomes')
            ->where('user_id', $userId)
            ->get();

        $creditDetails = $credits->map(function ($credit) {
            $totalExpenses = $credit->expenses->sum('amount');
            $totalIncomes = $credit->incomes->sum('amount');
            $balance = $totalIncomes - $totalExpenses;

            return [
                'bank' => $credit->bank->value ?? 'Unknown Bank', // Ensure this handles null values
                'totalExpenses' => $totalExpenses,
                'totalIncomes' => $totalIncomes,
                'balance' => $balance,
            ];
        });

        // Get all days of the current month
        $daysInMonth = collect(range(1, Carbon::now()->daysInMonth))
            ->map(fn($day) => str_pad($day, 2, '0', STR_PAD_LEFT)); // Format days as "01", "02", etc.

        // Monthly Expenses
        $monthlyExpenses = Expense::where('user_id', $userId)
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->get()
            ->groupBy(fn($expense) => Carbon::parse($expense->date)->format('d')); // Group by day of the month

        $barExpenseData = $daysInMonth->mapWithKeys(function ($day) use ($monthlyExpenses) {
            $total = $monthlyExpenses->get($day)?->sum('amount') ?? 0;
            return [$day => $total];
        });

        // Monthly Incomes
        $monthlyIncomes = Income::where('user_id', $userId)
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->get()
            ->groupBy(fn($income) => Carbon::parse($income->date)->format('d')); // Group by day of the month

        $barIncomeData = $daysInMonth->mapWithKeys(function ($day) use ($monthlyIncomes) {
            $total = $monthlyIncomes->get($day)?->sum('amount') ?? 0;
            return [$day => $total];
        });

        // Pass Data to View
        return view('user.dashboard', [
            'creditDetails' => $creditDetails,
            'barExpenseLabels' => $barExpenseData->keys(),
            'barExpenseValues' => $barExpenseData->values(),
            'barIncomeLabels' => $barIncomeData->keys(),
            'barIncomeValues' => $barIncomeData->values(),
        ]);
    }
}





// class DashboardController extends Controller
// {

//     public function dashboard()
//     {
//         $userId = Auth::id();

//         // Fetch credit data
//         $credits = Credit::with('expenses', 'incomes')
//             ->where('user_id', $userId)
//             ->get();

//         $creditDetails = $credits->map(function ($credit) {
//             $totalExpenses = $credit->expenses->sum('amount');
//             $totalIncomes = $credit->incomes->sum('amount');
//             $balance = $totalIncomes - $totalExpenses;

//             return [
//                 'bank' => $credit->bank->value,
//                 'totalExpenses' => $totalExpenses,
//                 'totalIncomes' => $totalIncomes,
//                 'balance' => $balance,
//             ];
//         });

//         // Get all days of the current month
//         $daysInMonth = collect(range(1, Carbon::now()->daysInMonth))
//             ->map(fn($day) => str_pad($day, 2, '0', STR_PAD_LEFT)); // Format days as "01", "02", ...

//         // Monthly Expenses
//         $monthlyExpenses = Expense::where('user_id', $userId)
//             ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
//             ->get()
//             ->groupBy(function ($expense) {
//                 return Carbon::parse($expense->date)->format('d'); // Group by day of the month
//             });

//         $barExpenseData = $daysInMonth->mapWithKeys(function ($day) use ($monthlyExpenses) {
//             $total = $monthlyExpenses->get($day)?->sum('amount') ?? 0; // Use 0 if the day is missing
//             return [$day => $total];
//         });

//         // Monthly Incomes
//         $monthlyIncomes = Income::where('user_id', $userId)
//             ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
//             ->get()
//             ->groupBy(function ($income) {
//                 return Carbon::parse($income->date)->format('d'); // Group by day of the month
//             });

//         $barIncomeData = $daysInMonth->mapWithKeys(function ($day) use ($monthlyIncomes) {
//             $total = $monthlyIncomes->get($day)?->sum('amount') ?? 0; // Use 0 if the day is missing
//             return [$day => $total];
//         });

//         // Pass Data to View
//         return view('user.dashboard', [
//             'creditDetails' => $creditDetails,
//             'barExpenseLabels' => $barExpenseData->keys(), // Days of the month for expenses
//             'barExpenseValues' => $barExpenseData->values(), // Total expenses for each day
//             'barIncomeLabels' => $barIncomeData->keys(), // Days of the month for incomes
//             'barIncomeValues' => $barIncomeData->values(), // Total incomes for each day

//         ]);
//     }


// } -->
