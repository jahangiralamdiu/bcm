<?php

namespace App\Http\Controllers;

use App\constants\ExpenseStatus;
use App\Models\Deposit;
use App\Models\Expense;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::where('status', ExpenseStatus::APPROVED)->get();
        $pendingExpenses = Expense::whereIn('status', [ExpenseStatus::PENDING, ExpenseStatus::READY_FOR_DISBURSED])->get();
        return view('expenses.index', compact('expenses', 'pendingExpenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('expenses.create', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['status'] = ExpenseStatus::PENDING;
        Expense::create($data);
        return redirect('/expenses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus($id, $status)
    {
        $expense = Expense::find($id);
        if ($status == 'Rejected') {
            $expense->status = ExpenseStatus::REJECTED;
        } else {
            if ($expense->status == ExpenseStatus::PENDING) {
                if ($expense->source_of_money == 'INDIVIDUAL') {
                    $expense->status = ExpenseStatus::APPROVED;
                    Deposit::create(['depositor_id' => $expense->expended_by, 'amount' => $expense->amount,
                        'deposit_date' => $expense->expense_date, 'remarks' => 'Deposited by expense']);
                } else {
                    $expense->status = ExpenseStatus::READY_FOR_DISBURSED;
                }

            } else {
                $expense->status = ExpenseStatus::APPROVED;
            }
        }

        $expense->update();

        return redirect(route('expenses.index'));
    }
}
