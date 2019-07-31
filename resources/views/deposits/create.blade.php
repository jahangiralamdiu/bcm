@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Deposit') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('deposits.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="depositor" class="col-md-4 col-form-label text-md-right">{{ __('Depositor') }}</label>

                                <div class="col-md-6">
                                    <select id="depositor" name="depositor_id" class="form-control{{ $errors->has('depositor_id') ? ' is-invalid' : '' }}" required>
                                        <option>Select Depositor</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('depositor_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('depositor_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

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
                                <label for="deposit_date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                                <div class="col-md-6">
                                    <input id="deposit_date" type="date" class="form-control{{ $errors->has('deposit_date') ? ' is-invalid' : '' }}"
                                           name="deposit_date" value="{{ old('deposit_date') }}" required>

                                    @if ($errors->has('deposit_date'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('deposit_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="remarks" class="col-md-4 col-form-label text-md-right">{{ __('Remarks') }}</label>

                                <div class="col-md-6">
                                    <input id="remarks" type="text" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                                           name="remarks" value="{{ old('remarks') }}">

                                    @if ($errors->has('remarks'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('remarks') }}</strong>
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