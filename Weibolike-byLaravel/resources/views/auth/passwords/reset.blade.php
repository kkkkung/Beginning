@extends('layouts.default')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="post" class="form-signin" action="{{ route('password.update') }}">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label class="control-label" for="email">Email:</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ $email or old('email') }}" required autofocus>
            @if($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{$errors->has('password')? 'has-error' : ''}}">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @if($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

        </div>
        <div class="form-group {{ $errors->has('paasword_confirmation')?'has-error':'' }}">
            <label for="password_confirm">Confirm your password:</label>
            <input type="password" id="password_confirm" name="password_confirmation" class="form-control" required>
            @if($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <input type="submit" class="btn btn-primary " value="Confirm">
        </div>
    </form>

@stop