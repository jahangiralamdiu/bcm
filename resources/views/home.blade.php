@extends('layouts.app')

@section('content')
    <div class="container">
        @if($pendingExpenseCount > 0)
        <div class="alert alert-danger" role="alert">
            Total {{$pendingExpenseCount}} pending expense request.<a href="{{route('expenses.index')}}" class="alert-link">View Details</a>
        </div>
        @endif
        <div class="row justify-content-center mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Investment and Expense Summary
                    </div>
                    <div class="row">
                        <div class="col-4" id="investment" style="width: 300px; height: 200px;"></div>
                        <div class="col-4" id="invest-cost" style="width: 250px; height: 200px;"></div>
                        <div class="cal-4" id="cost" style="width: 280px; height: 200px;"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Deposits by investors
                    </div>
                    <div class="card-body">
                        <table id="deposit" class="table">
                            <thead>
                            <tr>
                                <th>Depositor</th>
                                <th>Mobile</th>
                                <th>Total amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deposits as $deposit)
                                <tr>
                                    <td>{{$deposit->name}}</td>
                                    <td>{{$deposit->mobile}}</td>
                                    <td>{{$deposit->total_amount}} TK.</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">Total Deposits = {{$deposits->sum('total_amount')}} TK.</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Expenses by products
                    </div>
                    <div class="card-body">
                        <table id="deposit" class="table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Total amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <td>{{$expense->name}}</td>
                                    <td>{{$expense->total_amount}} TK.</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        Total Expenses = {{$expenses->sum('total_amount')}} TK.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        let invbyuser = [];
        let depExp = [];
        let productType = [];
        $url = "{{url('/summary')}}";
        $.get( $url, function( data ) {
            invbyuser = data.invByUser;
            depExp = data.depExp;
            productType = data.productType;
        });
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawCostChart);
        google.charts.setOnLoadCallback(drawInvCostChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(invbyuser);

            var options = {
                title: 'Investment by User',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('investment'));
            chart.draw(data, options);
        }

        function drawCostChart() {
            var data = google.visualization.arrayToDataTable(productType);

            var options = {
                title: 'Costs by categories',
                pieHole: 0.2,
            };

            var chart = new google.visualization.PieChart(document.getElementById('cost'));
            chart.draw(data, options);
        }

        function drawInvCostChart() {
            var data = google.visualization.arrayToDataTable(depExp);

            var options = {
                title: 'Investment vs Expense',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('invest-cost'));
            chart.draw(data, options);
        }
    </script>
@endpush