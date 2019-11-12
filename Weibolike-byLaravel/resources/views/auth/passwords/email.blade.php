@extends('layouts.default')
@section('title', 'Reset Password')

@section('content')

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="form-signin"  method="post" action="{{ route('password.email') }}">
        <div class="form-group">
        <h1 class="h3 mb-3 font-weight-normal">Please input your email address:</h1>
        </div>
        <div class="form-group">
            <input type="text" name="email" class="form-control">
            @if($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Find The Password">
        {{ csrf_field() }}
        </div>
    </form>

@stop