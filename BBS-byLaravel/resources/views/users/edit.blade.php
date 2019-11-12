@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card col-md-10 col-md-offset-1">
            <div class="card-title pt-3">
                <h4>
                    <i class="fa fa-edit"></i>编辑个人资料
                </h4>
            </div>

            @include('common.error')

            <div class="card-body">
                <form method="POST" accept-charset="UTF-8" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="name-field">用户名</label>
                        <input type="text" name="name" class="form-control" id="name-field" value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="email-field">邮 箱</label>
                        <input type="text" name="email" id="email-field" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="form-group">
                        <label for="introduction-field">个人简介</label>
                        <textarea type="text" name="introduction" id="introduction-field" class="form-control" rows="3">{{ old('introduction', $user->introduction) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="avatar-label" for="avatar-field">用户头像</label>
                        <input type="file" name="avatar">

                        @if($user->avatar)
                            <br>
                            <img src="{{ $user->avatar }}" class="img-thumbnail img-responsive" width="200">
                        @endif
                    </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">保 存</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

@stop