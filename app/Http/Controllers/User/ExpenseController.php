<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Credit;


class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        $credits = Credit::all();
        return view('user.expense.index', compact('expenses','credits'));
    }


    public function store(Request $request)
    {


        $validatedData = request()->validate([
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'credit_id' => 'required',
        ]);


        Expense::query()->create([
            'type' => $validatedData['type'],
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
            'credit_id' => $validatedData['credit_id'],
        ]);

        return redirect()->route('user.expense.index')->with('success', 'Expense created successfully!');
    }



    public function update(Request $request, $id)
    {
        $validatedData = request()->validate([
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'credit_id' => 'required',
        ]);

        Expense::query()->findOrFail($id)->update([
            'type' => $validatedData['type'],
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
            'credit_id' => $validatedData['credit_id']
        ]);
        return redirect()->route('user.expense.index')->with('success', 'Expense updated successfully!');
    }

    public function destroy($id)
    {
        $expense = Expense::query()->find($id);

        $expense->delete();

        return redirect()->route('user.expense.index')->with('success', 'Expense deleted successfully!');
    }
}
