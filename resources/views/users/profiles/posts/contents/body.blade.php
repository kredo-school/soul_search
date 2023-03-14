<div class="row">
    <div class="col-auto">
        <a href="#">
            @if ($post->user->avatar)
                <img src="{{ asset('/storage/images/'. $post->user->avatar) }}" class="" alt="">
            @else
                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
            @endif
        </a>

    </div>
    <div class="col">
        <span class="fw-bold">{{ Auth::user()->name }}</span>
        <div>
            {{ $post->created_at->diffForHumans() }} -
            @if ($post->view_count <= 1)
                <span class="fw-bold">{{ $post->view_count }}</span> View
            @else
                <span class="fw-bold">{{ $post->view_count }}</span> Views
            @endif
        </div>
    </div>
    <div class="col-auto">
        <button class="btn shadow-none" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
            <i class="fa-solid fa-ellipsis"></i>
        </button>
        {{-- edit and delete / report --}}
        @if(Auth::id() === $post->user_id)
            <ul class="dropdown-menu float-end" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                        <i class="fa-regular fa-pen-to-square"></i> Edit
                    </a>
                </li>
                <li>
                    <a href="" class="dropdown-item text-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deletePostModal">
                        <i class="fa-regular fa-trash-can"></i> Delete
                    </a>
                </li>
            </ul>
            @include('users.profiles.posts.modal.delete')
        @else
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a href="#" class="dropdown-item text-danger" title="Report" data-bs-toggle="modal" data-bs-target="#reportPostModal">
                        <i class="fa-solid fa-exclamation"></i> Report
                    </a>
                </li>
            </ul>
            @include('users.profiles.posts.modal.report')
        @endif
    </div>
</div>

<div class="mt-3">
    {{$post->body}}
</div>
<div>
    @foreach($tags as $tag)
        <a href="#" class="text-decoration-none">#{{ $tag->tag }}</a>&nbsp;
    @endforeach
</div>
<div class="row">
    <div class="col-auto">
        @if ($post->isLiked(Auth::id()))
            <form action="{{ route('postlike.destroy', $post->id) }}" method="post" class="mt-1 ms-1">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm shadow-none p-0" type="submit">
                    <i class="fa-solid fa-heart text-danger"></i>
                </button>
            </form>
        @else
            <form action="{{ route('postlike.store') }}" method="post" class="mt-1 ms-1">
                @csrf
                <input type="hidden" value="{{ $post->id }}" name="post_id">
                <button class="btn btn-sm shadow-none p-0" type="submit">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </form>
        @endif
    </div>
    <div class="col">
        @if ($post->likes->count() <= 1)
            <span class="fw-bold">{{ $post->likes->count() }}</span> Like
        @else
            <span class="fw-bold">{{ $post->likes->count() }}</span> Likes
        @endif

    </div>
</div>
<hr>