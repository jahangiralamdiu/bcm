@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{route('products.create')}}" role="button" class="btn btn-success mb-1"><i class="fas fa-plus"></i> Add New Product</a>
                <div class="card">
                    <div class="card-header">Products</div>

                    <div class="card-body">
                        <table id="deposit" class="table">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->productType->name}}</td>
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
