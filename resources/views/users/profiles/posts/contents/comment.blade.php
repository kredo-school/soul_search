<div>
    {{-- submit comment --}}
    <form action="{{ route('comments.store', $post->id) }}" method="post">
    @csrf
    <div class="input-group mb-3 px-3">
        <input type="text" class="form-control" id="comment" name="comment" placeholder="comment here">
        <button type="submit" class="input-group-text border-secondary">send</button>
    </div>
    </form>

    {{-- show comments --}}
    @if ($post->comments->isNotEmpty())
    <ul class="list-group post-list">
        @foreach ($post->comments as $comment)
        <li class="list-group-item border-0 p-0 mb-2">
            <div class="row">
                <div class="col-auto ms-4">
                    <a href="{{ route('profiles.show', $comment->user->id) }}">
                        @if ($comment->user->avatar)
                            <img src="/uploads/avatars/{{ $comment->user->avatar }}" class="avatar-sm rounded-circle" alt="">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                        @endif
                    </a>
                </div>
                <div class="col ms-3">
                    <span class="fw-bold">
                        {{ $comment->user->username }}
                    </span>
                    <span class="text-muted small">
                        {{ $comment->created_at->diffForHumans() }}
                    </span>
                    <div class="row d-flex align-items-center">
                        <div class="col">
                            {{ $comment->comment }}
                        </div>
                    </div>
                </div>

                <div class="col-auto me-2">
                    <button class="btn shadow-none" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    {{-- edit and delete / report --}}
                    @if(Auth::id() === $comment->user_id)
                        <ul class="dropdown-menu float-end" aria-labelledby="dropdownMenuButton2">
                            <li>
                                <a href="" class="dropdown-item text-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteCommentModal">
                                    <i class="fa-regular fa-trash-can"></i> Delete
                                </a>
                            </li>
                        </ul>
                        @include('users.profiles.posts.contents.modal.delete')
                    @else
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <li>
                                <a href="#" class="dropdown-item text-danger" title="Report" data-bs-toggle="modal" data-bs-target="#reportCommentModal">
                                    <i class="fa-solid fa-exclamation"></i> Report
                                </a>
                            </li>
                        </ul>
                        @include('users.profiles.posts.contents.modal.report')
                    @endif
                    <div class="row d-flex align-items-center">
                        <div class="col-auto">
                            @if ($like = $comment->like(Auth::id()))
                                <form action="{{ route('reactions.destroy', ['post' => $post->id, 'comment' => $comment->id, 'reaction' => $like->pivot->id]) }}" method="post" class="mt-1 ms-1">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm shadow-none p-0 float-start" type="submit">
                                        <i class="fa-solid fa-heart text-danger"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('reactions.store', ['post' => $post->id, 'comment' => $comment->id]) }}" method="post" class="mt-1 ms-1">
                                    @csrf
                                    <input type="hidden" value="{{ $comment->id }}" name="comment_id">
                                    <button class="btn btn-sm shadow-none p-0 float-start" type="submit">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div class="col-auto ms-1">
                                <span class="fw-bold float-start">{{ $comment->likes->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    @endif

</div>
