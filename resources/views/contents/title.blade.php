<div class="container">
    <!-- User Avatar -->
    <a href="{{ route('profile.show', $chat->user->id) }}">
        @if ($chat->user->avatar)
            <img src="{{ asset('storage/avatars/' . $chat->user->avatar) }}" alt="{{ $chat->user->avatar }}" class="rounded-circle icon-sm">
        @else
            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
        @endif
    </a>
</div>
