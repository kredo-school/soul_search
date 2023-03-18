<div class="container p-0">
    <div class="row">
        <!-- Username and Date -->
        <div class="col pt-0 ps-2">
            <a href="#" class="text-decoration-none text-dark fw-bold">{{ $chat->user->username }}</a>
            &nbsp;&nbsp;<span class="text-muted fw-light small tag-name">{{ date('m/d/Y H:i', strtotime($chat->created_at)) }}</span>
        </div>
        <!-- A Heart Button and Number of Likes -->
        <div class="col-auto text-end">
            @if ($chat->isLiked())
                <form action="{{ route('chat.like.destroy', $chat->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm shdow-none">
                        <i class="fa-solid fa-heart text-danger"></i>
                    </button>
                </form>
            @else
                <form action="{{ route('chat.like.store', $chat->id) }}" class="post">
                    @csrf
                    <button type="submit" class="btn bnn-sm shadow-none">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </form>
            @endif
            <span>{{ $chat->likes->count() }}</span>
        </div>
        <!-- A Ellipsis button for Report Chat -->
        <div class="col-auto text-end me-5">
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
    <!-- Body -->
    <p class="text-dark fw-light ms-2 w-75">{{ $chat->chat }}</p>
    @if ($chat->image)
        <img src="{{ asset('storage/img/' . $chat->image) }}" alt="{{ $chat->image }}" class="img-fluid">
    @endif
</div>
