@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Product') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="product_type_id" class="col-md-4 col-form-label text-md-right">{{ __('Product Type') }}</label>

                                <div class="col-md-6">
                                    <select id="product_type_id" name="product_type_id" class="form-control{{ $errors->has('product_type_id') ? ' is-invalid' : '' }}" required>
                                        <option>Select Product Type</option>
                                        @foreach($productTypes as $productType)
                                            <option value="{{$productType->id}}">{{$productType->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('product_type'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('product_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection