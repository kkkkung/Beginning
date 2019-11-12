@if ($user->id !== Auth::user()->id)
    @if(Auth::user()->isFollowing($user->id))
        <form class="d-inline" method="post" action="{{ route('followers.destroy', $user) }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <button type="submit" class="btn btn-sm btn-default">Unfollow</button>
        </form>
        @else

        <form class="d-inline" method="post" action="{{ route('followers.store', $user) }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-sm btn-default">Follow</button>
        </form>
    @endif
@endif