
<ul class="list-group post-list">
    <li class="list-group-item border-0 p-0">

        <div class="row mt-2">
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
                <span class="fw-bold">{{ $post->user->username }}</span>
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
                            <a href="{{ route('posts.edit', $post->id) }}" class="dropdown-item">
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

        <div class="mt-2 ms-3" id="hash-link"></div>

        <div class="row">
            <div class="col-auto">
                @if ($like = $post->like(Auth::id()))
                    <form action="{{ route('responses.destroy', ['post' => $post->id, 'response' => $like->pivot->id]) }}" method="post" class="mt-1 ms-1">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm shadow-none p-0" type="submit">
                            <i class="fa-solid fa-heart text-danger"></i>
                        </button>
                    </form>
                @else
                    <form action="{{ route('responses.store', ['post' => $post->id]) }}" method="post" class="mt-1 ms-1">
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
    </li>
</ul>

<hr>

<script>
    let string = "{{$post->text}}";
    let pattern = /#(\w+)/g; // tags

    let matches = string.match(pattern); // get the matched words

    // set links to the matched words
    let links = {};
    @foreach ($post->postTags as $post_tag)
        var name = '#{{$post_tag->tag->name}}';
        links[name] = "{{route('chats.show',$post_tag->tag_id)}}";
    @endforeach

    let result = string.replace(pattern, function(match) {
      // replace the matched word with a link
      return '<a href="' + links[match] + '" class="text-decoration-none">' + match + '</a>';
    });
    console.log(result);

    // set the HTML content of an element with the result
    let hashLink = document.getElementById("hash-link");
    hashLink.innerHTML = result;

</script>
