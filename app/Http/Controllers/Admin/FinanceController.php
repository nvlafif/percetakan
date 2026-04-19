<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index()
    {
        $incomes = Income::orderBy('date', 'desc')->paginate(10);
        $expenses = Expense::orderBy('date', 'desc')->paginate(10);
        
        $totalIncome = Income::where('status', 'received')->sum('amount');
        $totalExpense = Expense::where('status', 'paid')->sum('amount');
        $profit = $totalIncome - $totalExpense;

        return view('admin.finance.index', compact('incomes', 'expenses', 'totalIncome', 'totalExpense', 'profit'));
    }

    public function incomeStore(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'status' => 'required|in:pending,received',
        ]);

        Income::create($request->all());

        return redirect()->route('admin.finance.index')->with('success', 'Income added successfully');
    }

    public function expenseStore(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'status' => 'required|in:pending,paid',
        ]);

        Expense::create($request->all());

        return redirect()->route('admin.finance.index')->with('success', 'Expense added successfully');
    }

    public function report()
    {
        $monthlyIncomes = Income::select(
            DB::raw('MONTH(date) as month'),
            DB::raw('YEAR(date) as year'),
            DB::raw('SUM(amount) as total')
        )
        ->where('status', 'received')
        ->groupBy('month', 'year')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

        $monthlyExpenses = Expense::select(
            DB::raw('MONTH(date) as month'),
            DB::raw('YEAR(date) as year'),
            DB::raw('SUM(amount) as total')
        )
        ->where('status', 'paid')
        ->groupBy('month', 'year')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

        return view('admin.finance.report', compact('monthlyIncomes', 'monthlyExpenses'));
    }
}