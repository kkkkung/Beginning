<div class="pt-5 pb-3">
<a href="{{ route('users.show', [$user -> id] ) }}">
    <img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar pt-5">
</a>
<h1>{{ $user->name }}</h1>
</div>