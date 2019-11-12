@extends('layouts.default')
@section('title', 'All User')

@section('content')
        <div class="my-3 p-3 bg-gray rounded box-shadow ">
            <h6 class="border-bottom border-gray pb-2 mb-0 text-md-left">All User</h6>
            @foreach($users as $user)
            <div class="media text-muted pt-3 pb-2">
                <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-md-between align-items-center w-100">
                        <strong class="text-gray-dark">{{ $user->name }}</strong>
                        <div class="align-content-sm-start">
                            @include('users._follow_form')
                        @can('destroy',$user)
                                <form class="d-inline" method="post" action="{{ route('users.destroy', $user) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                </form>

                            @endcan
                        <a class="d-inline" href="{{ route('users.show', $user->id) }}">View</a>
                        </div>
                    </div>
                    <span class=" text-md-left d-block">{{ $user->email }}</span>
                </div>
            </div>
            @endforeach
            <div class="mt-5">
                {{-- Laravel 5.6 中使用 {{ $users->links() }}--}}
                {!! $users->render() !!}
            </div>
        </div>
@stop