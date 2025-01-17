<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Enum\IncomeType;


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
            'date' => 'required|date',
            'credit_id' => 'required|exists:credits,id',
        ]);


        $credit = Credit::where('id', $validatedData['credit_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        Income::create([
            'incomeType' => $validatedData['incomeType'],
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
            'date' =>$validatedData['date'],
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
            'date' => 'required|date',
            'credit_id' => 'required|exists:credits,id',
        ]);


        $credit = Credit::where('id', $validatedData['credit_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $income->update([
            'incomeType' => $validatedData['incomeType'],
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
            'date' =>$validatedData['date'],
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


    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt,xlsx|max:2048',
        ]);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found at the temporary path.');
        }

        try {
            $this->importTransactionsFromCsv($filePath);

            return redirect()->route('user.income.index')->with('success', 'Transactions imported successfully!');
        } catch (\Exception $e) {
            return redirect()->route('user.income.index')->with('error', 'Error importing transactions: ' . $e->getMessage());
        }
    }

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
    public function type()
    {
        $incomeData = Income::selectRaw('incomeType, SUM(amount) as total_amount')
            ->groupBy('incomeType')
            ->get()
            ->map(function ($income) {
                return [
                    'type' => $income->incomeType->value, // Enum value (e.g., "Salary", "Business")
                    'total_amount' => $income->total_amount,
                ];
            });

        // Calculate the total income for percentage calculations
        $totalIncome = $incomeData->sum('total_amount');

        // Prepare data for the charts
        $pieChartData = $incomeData->map(function ($income) use ($totalIncome) {
            return [
                'type' => $income['type'],
                'percentage' => ($income['total_amount'] / $totalIncome) * 100,
            ];
        });

        $barChartData = $incomeData;

        return view('user.incomeType.index', compact('pieChartData', 'barChartData'));
    }



}
