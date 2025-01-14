<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{

    public function index()
    {
        $incomes = Income::whereHas('credit', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        $credits = Credit::where('user_id', Auth::id())->get();

        return view('user.income.index', compact('incomes', 'credits'));
    }


    public function store(Request $request)
    {
        $userId= Auth::id();

        $validatedData = $request->validate([
            'incomeType' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'credit_id' => 'required|exists:credits,id',
        ]);


        $credit = Credit::where('id', $validatedData['credit_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        Income::create([
            'incomeType' => $validatedData['incomeType'],
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
            'credit_id' => $credit->id,
            'user_id' => $userId,
        ]);

        return redirect()->route('user.income.index')->with('success', 'Income created successfully!');
    }


    public function update(Request $request, $id)
    {
        $income = Income::where('id', $id)
            ->whereHas('credit', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $validatedData = $request->validate([
            'incomeType' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'credit_id' => 'required|exists:credits,id',
        ]);


        $credit = Credit::where('id', $validatedData['credit_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $income->update([
            'incomeType' => $validatedData['incomeType'],
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
            'credit_id' => $credit->id,
        ]);

        return redirect()->route('user.income.index')->with('success', 'Income updated successfully!');
    }


    public function destroy($id)
    {
        $income = Income::where('id', $id)
            ->whereHas('credit', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $income->delete();

        return redirect()->route('user.income.index')->with('success', 'Income deleted successfully!');
    }
}
