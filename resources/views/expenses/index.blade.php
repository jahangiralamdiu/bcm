@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('expenses.create')}}" role="button" class="btn btn-link">Create</a>
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
            $('#expense').DataTable();
        } );
    </script>
@endpush
