<?php

namespace App\Http\Controllers;

use App\constants\ExpenseStatus;
use App\Models\Deposit;
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

    public function summary()
    {
        $response = new \stdClass();
        $deposits = DB::table('deposits')
            ->join('users', 'deposits.depositor_id', '=', 'users.id')
            ->select('users.name', DB::raw('SUM(deposits.amount) as total_amount'))
            ->groupBy('depositor_id')
            ->get();
        $invByUser = [['Investment', 'Investment per user']];
        foreach ($deposits as $deposit) {
            array_push($invByUser, [$deposit->name, $deposit->total_amount]);
        }
        $totalExpense = Expense::where('status', ExpenseStatus::APPROVED)->sum('amount');
        $totalDeposit = Deposit::sum('amount');
        $depExp = [
            ['Investment-Expense', 'Investment vs Expense'],
            ['Investment', $totalDeposit],
            ['Expense', $totalExpense]
        ];

        $expenses = DB::table('expenses')
            ->join('products', 'expenses.product_id', '=', 'products.id')
            ->select('expenses.product_id', 'products.name', 'products.product_type_id', DB::raw('SUM(expenses.amount) as total_amount'))
            ->where('status', ExpenseStatus::APPROVED)
            ->groupBy('expenses.product_id')
            ->get();

        $service = 0;
        $goods = 0;

        foreach ($expenses as $exp) {
            if ($exp->product_type_id == 1) {
                $service += $exp->total_amount;
            } else {
                $goods += $exp->total_amount;
            }
        }
        $productType = [
            ['Costs', 'Costs per category'],
            ['Service', $service],
            ['Goods', $goods]
        ];
        $response->invByUser = $invByUser;
        $response->depExp = $depExp;
        $response->productType = $productType;

        return response()->json($response);
    }
}
