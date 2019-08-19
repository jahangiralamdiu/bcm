@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{route('register')}}" class="btn btn-success mb-1"><i class="fas fa-plus"></i> Add New
                    User</a>
                <div class="card">
                    <div class="card-header">Users</div>

                    <div class="card-body">
                        <table id="deposit" class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->mobile}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->address}}</td>
                                    <td>
                                        <a href="#" role="button" class="btn btn-secondary"><i class="far fa-edit"></i>Edit</a>
                                        <a href="#" role="button" class="btn btn-danger"><i
                                                    class="fas fa-trash-alt"></i> Delete</a>
                                    </td>
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
        $(document).ready(function () {
            $('#deposit').DataTable();
        });
    </script>
@endpush
