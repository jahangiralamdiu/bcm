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

                            <div class="form-group">
                                <label for="product_type_id">{{ __('Product Type') }}</label>
                                <select id="product_type_id" name="product_type_id"
                                        class="form-control{{ $errors->has('product_type_id') ? ' is-invalid' : '' }}"
                                        required>
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

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                            <button type="reset" class="btn btn-dark">
                                {{ __('Reset') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection