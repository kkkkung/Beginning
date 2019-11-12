
    <div class="media text-muted pt-3">

        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray text-right">
            <strong class="d-block text-white text-lg-left ">{{ $status->content }}</strong>

             <small>From <a href="{{ route('users.show', $status->user->id) }}">{{$status->user->name }}</a></small>

            {{ $status->created_at->diffForHumans() }}
            @can('destroy',$status)
                <strong class=" text-gray-dark text-right pl-1">
                    <a href="#" onclick="document.getElementById('reqForm').submit();return false">DELETE</a>
                </strong>
            @endcan
        </p>

    </div>

    <form id="reqForm" method="post" action="{{ route('statuses.destroy', $status->id) }}">
        {{ method_field('delete') }}
        {{ csrf_field() }}
    </form>
