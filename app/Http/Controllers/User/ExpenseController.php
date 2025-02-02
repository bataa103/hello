<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enum\ExpenseType;

class ExpenseController extends Controller
{

    public function index()
    {
        $expenses = Expense::whereHas('credit', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        $credits = Credit::where('user_id', Auth::id())->get();

        return view('user.expense.index', compact('expenses', 'credits'));
    }


    public function store(Request $request)
    {
        $userId = Auth::id();

        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'credit_id' => 'required|exists:credits,id',
        ]);


        $credit = Credit::where('id', $validatedData['credit_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        Expense::create([
            'type' => $validatedData['type'],
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
            'date' =>$validatedData['date'],
            'credit_id' => $credit->id,
            'user_id' => $userId,
        ]);

        return redirect()->route('user.expense.index')->with('success', 'Expense created successfully!');
    }


    public function update(Request $request, $id)
    {
        $expense = Expense::where('id', $id)
            ->whereHas('credit', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'credit_id' => 'required|exists:credits,id',
        ]);


        $credit = Credit::where('id', $validatedData['credit_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $expense->update([
            'type' => $validatedData['type'],
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
            'date' =>$validatedData['date'],
            'credit_id' => $credit->id,
        ]);

        return redirect()->route('user.expense.index')->with('success', 'Expense updated successfully!');
    }


    public function destroy($id)
    {
        $expense = Expense::where('id', $id)
            ->whereHas('credit', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $expense->delete();

        return redirect()->route('user.expense.index')->with('success', 'Expense deleted successfully!');
    }
    // New Method: Import CSV



    public function type()
    {
        $expenseData = Expense::selectRaw('type, SUM(amount) as total_amount')
            ->groupBy('type')
            ->get()
            ->map(function ($expense) {
                return [
                    'type' => $expense->type->value,
                    'total_amount' => $expense->total_amount,
                ];
            });

        $totalExpenses = $expenseData->sum('total_amount');

        $pieChartData = $expenseData->map(function ($expense) use ($totalExpenses) {
            return [
                'type' => $expense['type'],
                'percentage' => ($expense['total_amount'] / $totalExpenses) * 100,
            ];
        });

        $barChartData = $expenseData;

        return view('user.expenseType.index', compact('pieChartData', 'barChartData'));
    }


}
