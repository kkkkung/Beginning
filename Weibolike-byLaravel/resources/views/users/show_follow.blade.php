@extends('layouts.default')
@section('title', $title)

@section('content')
        <div class="panel panel-default bg-dark mt-5 ">
            <div class="panel-body">
                @if(count($users))
                    <div class="my-3 p-3 bg-gray rounded box-shadow ">
                        <h2 class="border-bottom border-gray pb-2 mb-0 text-md-left">{{ $title }}</h2>
                        @foreach($users as $user)
                            <div class="media text-muted pt-3 pb-2">
                                <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                    <div class="d-flex justify-content-md-between align-items-center w-100">
                                        <strong class="text-gray-dark">{{ $user->name }}</strong>
                                        <div class="align-content-sm-start">
                                            @if($title==="Followings")
                                                <form class="d-inline" method="post" action="{{ route('followers.destroy', $user) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button type="submit" class="btn btn-sm btn-default">Unfollow</button>
                                                </form>

                                            @endif
                                        </div>
                                    </div>
                                    <span class=" text-md-left d-block">{{ $user->email }}</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-5">
                            {!! $users->render() !!}
                        </div>
                    </div>

                    @else
                    <div class="empty-block">没有任何数据~~</div>

                @endif


            </div>
        </div>

@stop