@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('deposits.create')}}" role="button" class="btn btn-link">Create</a>
                <div class="card">
                    <div class="card-header">Deposits</div>

                    <div class="card-body">
                        <table id="deposit" class="table">
                            <thead>
                            <tr>
                                <th>Deposited By</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deposits as $deposit)
                                <tr>
                                    <td>{{$deposit->depositor->name}}</td>
                                    <td>{{$deposit->amount}}</td>
                                    <td>{{$deposit->deposit_date}}</td>
                                    <td>{{$deposit->remarks}}</td>
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
            $('#deposit').DataTable();
        } );
    </script>
@endpush
