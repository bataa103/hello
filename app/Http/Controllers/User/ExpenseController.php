<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function importCsv(Request $request)
    {
        dd($request->all());
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $filePath = $request->file('csv_file')->getPathname();

        try {
            // Parse and import the CSV file
            $this->importTransactionsFromCsv($filePath);

            return redirect()->route('user.expense.index')->with('success', 'Transactions imported successfully!');
        } catch (\Exception $e) {
            return redirect()->route('user.expense.index')->with('error', 'Error importing transactions: ' . $e->getMessage());
        }
    }

    // Helper function to process the CSV file
    private function importTransactionsFromCsv($filePath)
    {
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file);

        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

            $credit = Credit::where('IBAN', $data['IBAN'])->where('user_id', Auth::id())->first();

            if ($credit) {
                if (!empty($data['Кредит гүйлгээ'])) {
                    Income::create([
                        'incomeType' => $data['Төрөл'] ?? 'General',
                        'amount' => (float) str_replace(',', '', $data['Кредит гүйлгээ']),
                        'description' => $data['Гүйлгээний утга'] ?? '',
                        'date'=> $data['Гүйлгээний огноо']?? '',
                        'credit_id' => $credit->id,
                        'user_id' => Auth::id(),
                    ]);
                }

                if (!empty($data['Дебит гүйлгээ'])) {
                    Expense::create([
                        'expenseType' => $data['Төрөл'] ?? 'General',
                        'amount' => (float) str_replace(',', '', $data['Дебит гүйлгээ']),
                        'description' => $data['Гүйлгээний утга'] ?? '',
                        'date'=> $data['Гүйлгээний огноо']?? '',
                        'credit_id' => $credit->id,
                        'user_id' => Auth::id(),
                    ]);
                }
            }
        }

        fclose($file);
    }
}
