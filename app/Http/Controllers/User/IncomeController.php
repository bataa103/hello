<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Enum\IncomeType;
use Illuminate\Http\JsonResponse;
use App\Imports\IncomeImport;
use Illuminate\Support\Facades\Storage;






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



    public function type()
{
    $incomeData = Income::selectRaw('incomeType, SUM(amount) as total_amount')
        ->groupBy('incomeType')
        ->get()
        ->map(function ($income) {
            return [
                'type' => $income->incomeType, // Assuming `incomeType` is a string, not an enum
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

// public function getIncomeByDate(Request $request): JsonResponse
// {
//     $date = $request->input('date');

//     // Validate input
//     if (!$date) {
//         return response()->json(['error' => 'Date is required.'], 400);
//     }

//     // Calculate total income for the selected date
//     $totalIncome = Income::whereDate('date', $date)
//         ->whereHas('credit', function ($query) {
//             $query->where('user_id', Auth::id());
//         })
//         ->sum('amount');

//     return response()->json([
//         'date' => $date,
//         'totalIncome' => $totalIncome,
//     ]);
// }

    // public function import()
    // {
    //     // Ensure the file exists in storage/app
    //     $filePath = storage_path('app/users.xlsx');

    //     if (!file_exists($filePath)) {
    //         return redirect('/')->with('error', 'File not found!');
    //     }

    //     // Perform the import
    //     Excel::import(new IncomeImport, $filePath);

    //     return redirect('/')->with('success', 'Income data imported successfully!');
    // }
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048', // Ensure it's an Excel or CSV file
        ]);

        // Perform the import
        Excel::import(new IncomeImport, $request->file('file'));

        return redirect()->route('income.index')->with('success', 'Incomes imported successfully!');
    }


}







