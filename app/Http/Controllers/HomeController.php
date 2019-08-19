<?php

namespace App\Http\Controllers;

use App\constants\ExpenseStatus;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $deposits = DB::table('deposits')
            ->join('users', 'deposits.depositor_id', '=', 'users.id')
            ->select('deposits.depositor_id', 'users.name', 'users.mobile', DB::raw('SUM(deposits.amount) as total_amount'))
            ->groupBy('depositor_id')
            ->get();

        $expenses = DB::table('expenses')
            ->join('products', 'expenses.product_id', '=', 'products.id')
            ->select('expenses.product_id', 'products.name', DB::raw('SUM(expenses.amount) as total_amount'))
            ->where('status', ExpenseStatus::APPROVED)
            ->groupBy('expenses.product_id')
            ->get();

        $pendingExpenseCount = Expense::where('status', ExpenseStatus::PENDING)->count();

        return view('home', compact('deposits', 'expenses', 'pendingExpenseCount'));
    }
}
