<div class="container ms-1 pt-2">
    <!-- User Avatar -->
    <a href="{{ route('profiles.show', $chat->user->id) }}">
        @if ($chat->user->avatar)
            <img src="/uploads/avatars/{{ $chat->user->avatar }}" alt="{{ $chat->user->avatar }}" class="rounded-circle user-avatar">
        @else
            <i class="fa-solid fa-circle-user fa-4x text-secondary"></i>
        @endif
    </a>
</div>
