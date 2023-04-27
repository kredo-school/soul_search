<div class="container ps-3 pt-2">
    <div class="row justify-content-center" style="height: 1.5rem;">
        <!-- Username and Date -->
        <div class="col pt-0 ps-0">
            <a href="{{ route('profiles.show', $chat->user->id) }}" class="h5 text-decoration-none fw-bold text-dark tag-name">{{ $chat->user->username }}</a>
            &nbsp;&nbsp;<span class="text-muted fw-light small tag-name">{{ date('m/d/Y H:i', strtotime($chat->created_at)) }}</span>
        </div>
        <!-- A Heart Button and Number of Likes -->
        <div class="col-1 text-end chat-likes">
            @if ($chat->isLiked())
                <form action="{{ route('chat.like.destroy', $chat->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm shadow-none">
                        <i class="fa-solid fa-heart text-danger"></i>
                    </button>
                </form>
            @else
                <form action="{{ route('chat.like.store', $chat->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-sm shadow-none">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </form>
            @endif
        </div>
        <div class="col-1 px-0 pt-1 likes-count">
            <span>{{ $chat->likes->count() }}</span>
        </div>
        <!-- A Ellipsis button for Report Chat and Follow/Unfollow -->
        @if (Auth::user()->id !== $chat->user->id)
            <div class="col-auto text-end me-5">
                <div class="dropdown">
                    <button type="button" class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item text-danger" title="Report" data-bs-toggle="modal" data-bs-target="#reportChatModal">
                            <i class="fa-solid fa-circle-exclamation"></i> Report
                        </button>
                    </div>
                    @include('contents.modals.report')
                </div>
            </div>
        @endif
    </div>
    <!-- Body -->
    @if ($chat->image)
        <p class="chat-text ms-0 w-75 pt-1 mb-2">{{ $chat->chat }}</p>
        <img src="{{ asset('/storage/images/' . $chat->image) }}" alt="{{ $chat->image }}" class="img-fluid chat-image mb-4">
    @else
        <p class="chat-text ms-0 w-75 py-1">{{ $chat->chat }}</p>
    @endif
</div>
