@extends('layouts.default')

@section('title', $user->name)

@section('content')
    <section class="user_info">
        @include('shared._user_info', ['user' => $user])
        <div class="stats pb-5">
            <a href="{{ route('users.followings', $user->id) }}">
                <strong id="following" class="text-white pl-1">
                    {{ count($user->followings) }}
                </strong>
                关注
            </a>
            <a href="{{ route('users.followers', $user->id) }}">
                <strong id="followers" class="text-white pl-1">
                    {{ count($user->followers) }}
                </strong>
                粉丝
            </a>
            <a href="{{ route('users.show', $user->id) }}">
                <strong id="statuses" class="text-white pl-1">
                    {{ $user->statuses()->count() }}
                </strong>
                微博
            </a>
        </div>
        <div class="pt-3 pb-3">
            @if(Auth::user()->isFollowing($user->id))
                <form method="post" action="{{ route('followers.destroy', $user->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button class="btn btn-md btn-default" type="submit">UNFOLLOW</button>
                </form>
            @else
                <form method="post" action="{{ route('followers.store', $user->id) }}">
                    {{ csrf_field() }}
                    <button class="btn btn-md btn-default" type="submit">FOLLOW</button>
                </form>
            @endif

        </div>

        @can('update',$user,Auth::user())
            @include('statuses._status_form')
        @endcan
    </section>
    <div class="my-3 p-3 bg-gray rounded box-shadow">
        <h3 class="border-bottom border-gray pb-2 mb-0">All my Statuses here</h3>
    @if(count($statuses) > 0)
        @foreach($statuses as $status)
            @include('statuses._statuses')
            @endforeach

        @endif
        {!! $statuses->render() !!}
    </div>

@stop