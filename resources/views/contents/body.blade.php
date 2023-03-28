<div class="container pb-4">
    <div class="row" style="height: 1.5rem;">
        <!-- Username and Date -->
        <div class="col pt-0 ps-2">
            <a href="#" class="text-decoration-none text-dark fw-bold">{{ $chat->user->username }}</a>
            &nbsp;&nbsp;<span class="text-muted fw-light small tag-name">{{ date('m/d/Y H:i', strtotime($chat->created_at)) }}</span>
        </div>
        <!-- A Heart Button and Number of Likes -->
        <div class="col-auto text-end pe-4 chat-likes">
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
            <span class=" like-count">{{ $chat->likes->count() }}</span>
        </div>
        <!-- A Ellipsis button for Report Chat -->
        @if (Auth::user()->id !== $chat->user->id)
            <div class="col-auto text-end me-5">
            <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            <ul class="dropdown-menu">
                <li title="report" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#reportChatModal">
                    <i class="fa-solid fa-circle-exclamation"></i> Report
                </li>
            </ul>
        </div>
        @endif
    </div>
    <!-- Body -->
    <p class="text-dark fw-light ms-2 w-75">{{ $chat->chat }}</p>
    @if ($chat->image)
        <img src="{{ asset('/storage/images/' . $chat->image) }}" alt="{{ $chat->image }}" class="img-fluid chat-image">
    @endif
</div>
