<div class="container">
    <!-- User Avatar -->
    <a href="#">
        @if ($chat->user->avatar)
            <img src="{{ asset('storage/avatars/' . $chat->user->avatar) }}" alt="{{ $chat->user->avatar }}" class="rounded-circle">
        @else
            <i class="fa-solid fa-circle-user text-secondary"></i>
        @endif
    </a>
</div>
