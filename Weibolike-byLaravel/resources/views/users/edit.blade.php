@extends('layouts.default')
@section('title', '修改个人资料')

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">--}}
                {{--<h5>更改个人资料</h5>--}}
            {{--</div>--}}
            {{--<div class="panel-body">--}}
                {{--@include('shared._errors')--}}

                {{--<div class="gravatar_edit">--}}
                    {{--<a href="http://gravatar.com/emails" target="_blank">--}}
                        {{--<img src="{{ $user->gravatar('200') }}" alt="{{ $user->name }}" class="gravatar">--}}
                    {{--</a>--}}
                {{--</div>--}}


                {{--<form action="{{ route('users.update', $user->id) }}" method="post">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--{{ method_field('PATCH') }}--}}

                    {{--<div class="form-group">--}}
                        {{--<label for="name">名称：</label>--}}
                        {{--<input type="text" name="name" class="form-control" value="{{ $user->name }}">--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label for="email">邮箱：</label>--}}
                        {{--<input type="text" name="email" class="form-control" value="{{ $user->email}}" disabled>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label for="password">密码：</label>--}}
                        {{--<input type="password" name="password" class="form-control">--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label for="password_confirmation">确认密码：</label>--}}
                        {{--<input type="password" name="password_confirmation" class="form-control">--}}
                    {{--</div>--}}

                    {{--<button type="submit" class="btn btn-primary">更新</button>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-md-8">
            <div class="py-5 text-center">
                <h4 class="mb-3">Edit Your Page Now</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5">
            <form method="post" action="{{ route('users.update', $user->id) }}" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="username" class="text-md-left">Change Your Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <hr class="mb-4">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <button class="btn btn-primary btn-lg btn-block" type="submit">Update Data</button>
            </form>
                </div>
            </div>
        </div>
        </div>
@stop