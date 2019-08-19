@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('expenses.create')}}" role="button" class="btn btn-success mb-1"><i class="fas fa-plus"></i> Add New Expense</a>
        <div class="row justify-content-center mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Pending Requests</div>

                    <div class="card-body">
                        <table id="expense" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Source of Money</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pendingExpenses as $expense)
                                <tr>
                                    <td>{{$expense->product->name}}</td>
                                    <td>{{$expense->quantity}}</td>
                                    <td>{{$expense->expense_date}}</td>
                                    <td>{{$expense->amount}}</td>
                                    <td>{{$expense->source_of_money}}</td>
                                    <td>{{$expense->status}}</td>
                                    <td>
                                        <a href="{{url('/expense-status/'. $expense->id .'/'. 'Approved')}}" role="button" class="btn btn-success">
                                            {{$expense->status == 'Pending' ? 'Approve' : 'Disburse'}}
                                        </a>
                                        <a href="{{url('/expense-status/'. $expense->id .'/'. 'Rejected')}}" role="button" class="btn btn-danger">Reject</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Expenses</div>

                    <div class="card-body">
                        <table id="expense" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Source of Money</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <td>{{$expense->product->name}}</td>
                                    <td>{{$expense->quantity}}</td>
                                    <td>{{$expense->expense_date}}</td>
                                    <td>{{$expense->amount}}</td>
                                    <td>{{$expense->source_of_money}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-js')
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        } );
    </script>
@endpush
