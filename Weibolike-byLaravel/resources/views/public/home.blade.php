@extends('layouts.default')
@section('content')
    @if(!Auth::check())
        <h1 class="cover-heading">Hello Laravel.</h1>
        <p class="lead">开始一段新旅程.</p>
        <p class="lead">
            <a href="{{ route('signup') }}" class="btn btn-lg btn-secondary">现在注册</a>
        </p>
    @else
        <h1 class="cover-heading">Hello {{ Auth::user()->name }}.</h1>

        <div class="my-3 p-3 bg-gray rounded box-shadow">
            <h3 class="border-bottom border-gray pb-2 mb-0">All You Are Following</h3>
            @if(count($feed_items) > 0)
                @foreach($feed_items as $status)
                    @include('statuses._statuses')
                @endforeach

            @endif
        </div>
        {!! $feed_items->render() !!}

    @endif
@stop