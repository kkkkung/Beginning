@extends('layouts.default')

@section('title', 'Sign Up')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="h3 mb-3 font-weight-normal">Please Complete this form</h1>
        </div>
        <div class="panel-body">
            @include('shared._errors')

            <form class="form-signup" method="post" action="{{ route('users.store') }}">
                <div class="form-group">
                <label for="inputName" class="sr-only">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" required value="{{ old('name') }}">
                </div>

                <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus value="{{ old('email') }}">
                </div>

                <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required value="{{ old('password') }}">
                </div>

                <div class="form-group">
                <label for="inputPassword_confirmation" class="sr-only">Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required value="{{ old('password_confirmation') }}">
                </div>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@stop
