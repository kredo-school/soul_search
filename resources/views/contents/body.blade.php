<div class="container">
    <div class="row align-items-center">
        <!-- Username -->
        <div class="col ps-0">
            <a href="{{ route('profile.show', $chat->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $chat->user->username }}</a>
        </div>
        <!-- Date -->
        <div class="col">
            <p class="text-muted fw-light">{{ date('m/d/Y H:i', strtotime($chat->created_at)) }}</p>
        </div>
        <!-- A Heart Button and Number of Likes -->
        <div class="col-auto text-end">
            <i class="fa-regular fa-heart"></i>
            <span>{{ $chat->likes->count() }}</span>
        </div>
        <!-- A Ellipsis button for Report Chat -->
        <div class="col-auto text-end">
            <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            {{-- <div class="dropdown-menu">
                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#report-chat-{{ $chat-id }}">
                    Report Chat
                </button>
            </div> --}}
            {{-- @include(for Report) --}}
        </div>
    </div>

    <div class="row align-items-center">
        <p class="d-inline fw-light">{{ $chat->chat }}</p>
        @if ($chat->image)
            <img src="{{ asset('storage/images/' . $chat->image) }}" alt="{{ $chat->image }}">
        @endif
    </div>
</div>
