<div class="container ms-2 pt-2">
    <!-- User Avatar -->
    <a href="#">
        @if ($chat->user->avatar)
            <img src="{{ asset('/storage/avatars/' . $chat->user->avatar) }}" alt="{{ $chat->user->avatar }}" class="rounded-circle icon-sm">
        @else
            <i class="fa-solid fa-circle-user fa-4x text-secondary icon-sm"></i>
        @endif
    </a>
</div>
