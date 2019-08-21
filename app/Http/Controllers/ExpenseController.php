<?php

namespace App\Http\Controllers;

use App\constants\ExpenseStatus;
use App\Models\Deposit;
use App\Models\Expense;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
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
        $expenses = Expense::where('status', ExpenseStatus::APPROVED)->orderBy('id', 'desc')->get();
        $pendingExpenses = Expense::whereIn('status', [ExpenseStatus::PENDING, ExpenseStatus::READY_FOR_DISBURSED])->orderBy('id', 'desc')->get();
        return view('expenses.index', compact('expenses', 'pendingExpenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('add-expense')) {
            $users = User::all();
            $products = Product::all();
            return view('expenses.create', compact('users', 'products'));
        }

        Session::flash('error', trans('You do not have the permission to do the action'));

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('add-expense')) {
            $data = $request->all();
            $data['status'] = ExpenseStatus::PENDING;
            Expense::create($data);
            Session::flash('success', trans('Expense added successfully'));
            return redirect('/expenses');
        }

        Session::flash('error', trans('You do not have the permission to do the action'));

        return redirect()->back();
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
            if ($expense->status == ExpenseStatus::PENDING) {
                if (Gate::denies('approve-expense')) {
                    Session::flash('error', trans('You do not have the permission to do the action'));
                    return redirect(route('expenses.index'));
                }
            } else if ($expense->status == ExpenseStatus::READY_FOR_DISBURSED) {
                if (Gate::denies('disburse')) {
                    Session::flash('error', trans('You do not have the permission to do the action'));
                    return redirect(route('expenses.index'));
                }
            }
            $expense->status = ExpenseStatus::REJECTED;
            Session::flash('success', trans('Expense rejected successfully'));
        } else {
            if ($expense->status == ExpenseStatus::PENDING) {
                if (Gate::denies('approve-expense')) {
                    Session::flash('error', trans('You do not have the permission to do the action'));
                    return redirect(route('expenses.index'));
                }
                if ($expense->source_of_money == 'INDIVIDUAL') {
                    $expense->status = ExpenseStatus::APPROVED;
                    Deposit::create(['depositor_id' => $expense->expended_by, 'amount' => $expense->amount,
                        'deposit_date' => $expense->expense_date, 'remarks' => 'Deposited by expense']);
                } else {
                    $expense->status = ExpenseStatus::READY_FOR_DISBURSED;
                }

                Session::flash('success', trans('Expense approved successfully'));

            } else {
                if (Gate::denies('disburse')) {
                    Session::flash('error', trans('You do not have the permission to do the action'));
                    return redirect(route('expenses.index'));
                }
                $expense->status = ExpenseStatus::APPROVED;
                Session::flash('success', trans('Expense disbursed successfully'));
            }
        }

        $expense->update();

        return redirect(route('expenses.index'));
    }
}
