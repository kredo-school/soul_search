<div class="container">
    <div class="row align-items-center">
        {{-- User Avatar --}}
        <div class="col-auto">
            <a href="#">
                @if ($post->user->avatar)
                    <img src="{{ asset('storage/avatars/' . $chat->user->avatar) }}" alt="{{ $chat->user->avatar }}" class="rounded-circle">
                @else
                    <i class="fa-solid fa-circle-user text-secondary"></i>
                @endif
            </a>
        </div>
        {{-- Username --}}
        <div class="col ps-0">
            <a href="#" class="text-decoration-none text-dark">{{ $chat->user->username }}</a>
        </div>
        {{-- Date --}}
        <div>
            <p class="text-muted">{{ date('m/d/Y H:i', strtotime($chat->created_at)) }}</p>
        </div>
        {{-- A Heart Button and Number of Likes --}}
        <div class="col-auto text-end">
            <i class="fa-regular fa-heart"></i>
        </div>
        {{-- A Ellipsis button for Report Chat --}}
        <div class="col-auto text-end">
            <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            <div class="dropdown-menu">
                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#report-chat-{{ $chat-id }}">
                    Report Chat
                </button>
            </div>
            {{-- @include(for Report) --}}
        </div>
    </div>
</div>
