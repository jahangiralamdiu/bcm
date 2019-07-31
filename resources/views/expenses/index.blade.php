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
                                <th>Expense By</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Md. Jahangir Alam</td>
                                <td>10 June 2018</td>
                                <td>BDT 5000.00</td>
                            </tr>
                            <tr>
                                <td>Md. Masud Rana</td>
                                <td>12 June 2018</td>
                                <td>BDT 3000.00</td>
                            </tr>
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
