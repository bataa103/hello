<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Example: Replace with actual data retrieval logic
        $incomeData = [1000, 1200, 1500, 1400, 1700, 1800, 2000, 1900, 2100, 2200, 2500, 2600];
        $expenseData = [800, 950, 1100, 1200, 1300, 1250, 1400, 1350, 1500, 1600, 1700, 1800];

        return view('dashboard', compact('incomeData', 'expenseData'));
    }
}
