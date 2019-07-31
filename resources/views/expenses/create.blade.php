@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Expense') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('expenses.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="product_id" class="col-md-4 col-form-label text-md-right">{{ __('Product') }}</label>

                                <div class="col-md-6">
                                    <select id="product_id" name="product_id" class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" required>
                                        <option>Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('product_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('product_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                                <div class="col-md-6">
                                    <input id="quantity" type="number" min="1" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" value="{{ old('quantity') }}" required>

                                    @if ($errors->has('quantity'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                    @endif
                                    <label for="unit">Unit</label>
                                    <select id="unit" name="unit">
                                        <option value="na">N/A</option>
                                        <option value="kg">KG</option>
                                        <option value="ton">TON</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Total Amount (BDT)') }}</label>

                                <div class="col-md-6">
                                    <input id="amount" type="number" min="1" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" required>

                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="expense_date" class="col-md-4 col-form-label text-md-right">{{ __('Expense Date') }}</label>

                                <div class="col-md-6">
                                    <input id="expense_date" type="date" class="form-control{{ $errors->has('expense_date') ? ' is-invalid' : '' }}"
                                           name="expense_date" value="{{ old('expense_date') }}" required>

                                    @if ($errors->has('expense_date'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('expense_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="source_of_money" class="col-md-4 col-form-label text-md-right">{{ __('Source of Money') }}</label>

                                <div class="col-md-6">
                                    <select id="source_of_money" name="source_of_money" class="form-control{{ $errors->has('source_of_money') ? ' is-invalid' : '' }}" required>
                                        <option>Select Source</option>

                                            <option value="FUND">Fund</option>
                                            <option value="INDIVIDUAL">Individual</option>
                                    </select>
                                    @if ($errors->has('source_of_money'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('source_of_money') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="expended_by" class="col-md-4 col-form-label text-md-right">{{ __('Expended By') }}</label>

                                <div class="col-md-6">
                                    <select id="expended_by" name="expended_by" class="form-control{{ $errors->has('expended_by') ? ' is-invalid' : '' }}">
                                        <option value="">Select Person</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('expended_by'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('expended_by') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="details" class="col-md-4 col-form-label text-md-right">{{ __('Remarks') }}</label>

                                <div class="col-md-6">
                                    <input id="details" type="text" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}"
                                           name="details" value="{{ old('details') }}">

                                    @if ($errors->has('details'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('details') }}</strong>
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