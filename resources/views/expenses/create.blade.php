@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Expense') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('expenses.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="product_id">{{ __('Product') }}</label>

                                        <select id="product_id" name="product_id"
                                                class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}"
                                                required>
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

                                    <div class="form-group">
                                        <label for="quantity">{{ __('Quantity') }}</label>
                                        <input id="quantity" type="number" min="1"
                                               class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
                                               name="quantity" value="{{ old('quantity') }}" required>

                                        @if ($errors->has('quantity'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="unit">{{ __('Unit') }}</label>
                                        <select id="unit" class="form-control" name="unit">
                                            <option value="N/A">N/A</option>
                                            <option value="KG">KG</option>
                                            <option value="Ton">TON</option>
                                            <option value="Piece">Piece</option>
                                            <option value="Meter">Meter</option>
                                            <option value="Feet">Feet</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="unit_price">{{ __('Unit Price') }}</label>
                                        <input id="unit_price" type="number"
                                               class="form-control{{ $errors->has('unit_price') ? ' is-invalid' : '' }}"
                                               name="unit_price" value="{{ old('unit_price') }}" required>

                                        @if ($errors->has('unit_price'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('unit_price') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="amount">{{ __('Total Amount (BDT)') }}</label>
                                        <input id="amount" type="number" min="1"
                                               class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                               name="amount" value="{{ old('amount') }}" required>

                                        @if ($errors->has('amount'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="expense_date">{{ __('Expense Date') }}</label>
                                        <input id="expense_date" type="date"
                                               class="form-control{{ $errors->has('expense_date') ? ' is-invalid' : '' }}"
                                               name="expense_date" value="{{ old('expense_date') }}" required>

                                        @if ($errors->has('expense_date'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('expense_date') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="source_of_money">{{ __('Source of Money') }}</label>
                                        <select id="source_of_money" name="source_of_money"
                                                class="form-control{{ $errors->has('source_of_money') ? ' is-invalid' : '' }}"
                                                required>
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
                                    <div class="form-group exp-by">
                                        <label for="expended_by">{{ __('Expended By') }}</label>
                                        <select id="expended_by" name="expended_by"
                                                class="form-control{{ $errors->has('expended_by') ? ' is-invalid' : '' }}">
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

                                    <div class="form-group">
                                        <label for="details">{{ __('Remarks') }}</label>
                                        <input id="details" type="text"
                                               class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}"
                                               name="details" value="{{ old('details') }}">

                                        @if ($errors->has('details'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
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
@push('page-js')
    <script>
        $(document).ready(function () {
            let manageExpendedBy = function () {
                const source = $('#source_of_money').val();
                if (source == 'INDIVIDUAL') {
                    $('.exp-by').show();
                } else {
                    $('.exp-by').hide();
                }
            };

            manageExpendedBy();
            $('#source_of_money').on('change', function () {
                manageExpendedBy();
            });

            $('#unit_price').on('keyup', function () {
                const quantity = $('#quantity').val();
                const price = $(this).val();
                let amount = Number(quantity) * Number(price);
                $('#amount').val(amount);
            });
        });
    </script>
@endpush