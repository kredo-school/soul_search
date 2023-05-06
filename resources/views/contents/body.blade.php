@foreach ($tagged_chats as $chat)
    <div class="row">
        <div class="col-auto">
            <div class="pt-2">
                <!-- User Avatar -->
                <a href="{{ route('profiles.show', $chat->user->id) }}">
                    @if ($chat->user->avatar)
                        <span class="d-none d-sm-inline">
                            <img src="/uploads/avatars/{{ $chat->user->avatar }}" alt="{{ $chat->user->avatar }}" class="rounded-circle user-avatar">
                        </span>
                        <span class="d-inline d-sm-none">
                            <img src="/uploads/avatars/{{ $chat->user->avatar }}" alt="{{ $chat->user->avatar }}" class="rounded-circle user-avatar-sm">
                        </span>
                    @else
                        <span class="d-none d-sm-inline">
                            <i class="fa-solid fa-circle-user fa-4x text-secondary"></i>
                        </span>
                        <span class="d-inline d-sm-none">
                            <i class="fa-solid fa-circle-user fa-3x text-secondary"></i>
                        </span>
                    @endif
                </a>
            </div>
        </div>
        <div class="col">
            <div class="ps-3 pt-2">
                <div class="row justify-content-center" style="height: 1.5rem;">
                    <!-- Username and Date -->
                    <div class="col">
                        <a href="{{ route('profiles.show', $chat->user->id) }}" class="h5 text-decoration-none fw-bold text-dark tag-name">{{ $chat->user->username }}</a>
                        <span class="d-none d-sm-inline">
                            <span class="text-muted fw-light small tag-date ms-2">{{ date('m/d/Y H:i', strtotime($chat->created_at)) }}</span>
                        </span>
                        <span class="d-inline d-sm-none">
                            <span class="text-muted fw-light small tag-date ms-1">{{ date('m/d H:i', strtotime($chat->created_at)) }}</span>
                        </span>
                    </div>
                    <!-- A Heart Button and Number of Likes -->
                    <div class="col-auto">
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
                                <button type="submit" title="Like this chat" class="btn btn-sm shadow-none">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="col-auto pt-1">
                        <span>{{ $chat->likes->count() }}</span>
                    </div>

                    <!-- A Ellipsis button for Report Chat and Follow/Unfollow -->
                    <div class="col-auto">
                        <div class="row">
                            <div class="col dropdown">
                                <a type="button" class="text-decoration-none btn btn-sm shadow-none" id="dropdownMenuButtonChat{{$chat->id}}" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonChat{{$chat->id}}">
                                    @if (Auth::user()->id == $chat->user->id)
                                        <li>
                                            <button class="dropdown-item text-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteChatModal{{$chat->id}}">
                                                <i class="fa-regular fa-trash-can"></i> Delete
                                            </button>
                                        </li>
                                    @else
                                        <li>
                                            @if ($chat->user->followedBy(Auth::id()))
                                                <form action="{{ route('follows.destroy', ['user' => $chat->user->id, 'follow' => $chat->user->follows()->where('following_id', Auth::id())->first()->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn dropdown-item text-danger"><i class="fa-solid fa-user-minus text-danger pe-1"></i>Unfollow</button>
                                                </form>
                                            @else
                                                <form action="{{ route('follows.store', ['user' => $chat->user->id]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn dropdown-item text-primary"><i class="fa-solid fa-user-plus text-primary pe-1"></i>Follow</button>
                                                </form>
                                            @endif
                                        </li>
                                        <li>
                                            <button class="dropdown-item text-danger" title="Report" data-bs-toggle="modal" data-bs-target="#reportChatModal{{$chat->id}}">
                                                <i class="fa-solid fa-circle-exclamation pe-1"></i>Report
                                            </button>
                                        </li>
                                    @endif
                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- chat -->
            @if ($chat->image)
                <p class="chat-text ms-0 w-75 pt-1 ms-3 mb-2" style="white-space:pre-wrap;">{{ $chat->chat }}</p>
                <img src="/uploads/chats/{{ $chat->image }}" alt="{{ $chat->image }}" class="chat-image mb-4">
            @else
                <p class="chat-text ms-0 w-75 py-1 ms-3" style="white-space:pre-wrap;">{{ $chat->chat }}</p>
            @endif
        </div>
    </div>
    @include('contents.modals.delete')
    @include('contents.modals.report')
@endforeach
