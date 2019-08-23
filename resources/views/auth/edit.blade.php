@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('User Edit') }}</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input id="name" type="text"
                                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               name="name"
                                               value="{{ $user->name }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile">{{ __('Mobile') }}</label>
                                        <input id="mobile" type="text"
                                               class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                                               name="mobile" value="{{ $user->mobile }}" required>

                                        @if ($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email"
                                               value="{{ $user->email }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="address">{{ __('Address') }}</label>
                                        <textarea id="address" name="address"
                                                  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">{{$user->address}}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="roles">{{ __('Roles') }}</label>
                                        <select id="roles"
                                                class="form-control{{ $errors->has('roles') ? ' is-invalid' : '' }}"
                                                name="roles[]" required multiple>
                                            @foreach($roleList as $role)
                                                <option value="{{$role->id}}" {{ ($user->roles->contains($role->id)) ? 'selected':'' }}>{{$role->name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('roles'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
