<div>
    <div class="dropdown">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-ellipsis"></i>
        </button>
        <ul class="dropdown-menu">
            @if(Auth::id() === $post->user_id)
                <li>
                    <a class="dropdown-item" href="{{ route('post.edit', $post->id) }}">edit post</a>
                </li>
                <li>
				    <!-- delete post modal-->
                    <button class="dropdown-item btn btn-orange" type="button"  data-bs-toggle="modal" data-bs-target="#deletePostModal">
                        delete post
                    </button>
                    @include('users.profiles.posts.modal.delete')
                </li>
            @else
                <li>
                    <!-- report post modal-->
                    <button class="dropdown-item btn btn-orange" type="button"  data-bs-toggle="modal" data-bs-target="#reportPostModal">
                        report post
                    </button>
                    @include('users.profiles.posts.modal.report')
                </li>
            @endif
        </ul>
    </div>

    {{$post->body}}
    <br>
    @foreach($tags as $tag)
        <a href="#" class="text-decoration-none">#{{ $tag->tag }}</a>&nbsp;
    @endforeach
</div>
