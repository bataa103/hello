<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Credit;
use Illuminate\Http\Request;
use App\Enum\IncomeType;

class IncomeController extends Controller
{

    public function index()
    {
        $incomes = Income::all();
        $credits = Credit::all();
        return view('user.income.index', compact('incomes', 'credits'));
    }


    public function store(Request $request)
    {
        $validatedData = request()->validate([
            'incomeType' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'credit_id' => 'required',
        ]);

        Income::query()->create([
            'incomeType' => $validatedData['incomeType'],
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
            'credit_id' => $validatedData['credit_id'],
        ]);

        return redirect()->route('user.income.index')->with('success', 'Income created successfully!');
    }


    public function update(Request $request, $id)
    {
        $validatedData = request()->validate([
            'incomeType' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'credit_id' => 'required',
        ]);

        Income::query()->findOrFail($id)->update([
            'incomeType' => $validatedData['incomeType'],
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
            'credit_id' => $validatedData['credit_id'],
        ]);

        return redirect()->route('user.income.index')->with('success', 'Income updated successfully!');
    }

    // Delete an income
    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();

        return redirect()->route('user.income.index')->with('success', 'Income deleted successfully!');
    }
}
