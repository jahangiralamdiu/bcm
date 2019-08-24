@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{route('deposits.create')}}" role="button" class="btn btn-success mb-1"><i class="fas fa-plus"></i> Add New Deposit</a>
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
                                {{--<th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deposits as $deposit)
                                <tr>
                                    <td>{{$deposit->depositor->name}}</td>
                                    <td>{{$deposit->amount}}</td>
                                    <td>{{$deposit->deposit_date}}</td>
                                    <td>{{$deposit->remarks}}</td>
                                    {{--<td>--}}
                                        {{--<a href="#" role="button" class="btn btn-sm btn-secondary"><i class="far fa-edit"></i> Edit</a>--}}
                                        {{--<a href="#" role="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>--}}
                                    {{--</td>--}}
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
