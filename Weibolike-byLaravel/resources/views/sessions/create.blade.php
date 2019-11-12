@extends('layouts.default')

@section('title', 'Login Page')

@section('content')
    <form class="form-signin"  method="post" action="{{ route('login') }}">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" name="remember" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        {{ csrf_field() }}
    </form>
    <p><a href="{{ route('password.request') }}">Forget the password </a>?</p>



@stop