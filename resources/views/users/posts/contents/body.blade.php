<div class="container p-0">
    <a href="{{ route('post.show', $post->id) }}">
      @if (empty($post->image))
          <video class="w-100" src="{{ asset('/uploads/videos/' . $post->video) }}" controls></video>
      @else
          <img class="w-100" src="{{ asset('/storage/images/' . $post->image) }}" alt="Post Image">
      @endif
    </a>
  </div>

  <div class="card-body">
    <div class="row align-items-center">
      {{-- heart icon and count--}}
      <div class="col-auto">
          @if ($post->isLiked(Auth::user()->id))
              <form action="{{ route('like.destroy', $post->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm shadow-none p-0" type="submit">
                      <i class="fa-solid fa-heart text-danger"></i>
                  </button>
              </form>
          @else
              <form action="{{ route('like.store')}}" method="post">
                  @csrf
                  <input type="hidden" value="{{ $post->id }}" name="post_id">
                  <button class="btn btn-sm shadow-none p-0" type="submit">
                      <i class="fa-regular fa-heart"></i>
                  </button>
              </form>
          @endif
      </div>
      <div class="col-auto px-0">
          <span>{{ $post->likes->count() }}</span>
      </div>
      {{-- categories --}}
      <div class="col text-end">
        @foreach ($post->categoryPost as $categoryPost)
          <span class="badge bg-secondary bg-opacity-50">
            {{ $categoryPost->category->name }}
          </span>
        @endforeach
      </div>
    </div>
    {{-- owner and description --}}
    <a href="{{ route('user.show', $post->user_id) }}" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
    &nbsp;
    <p class="d-inline fw-light">{{ $post->description }}</p>
    <p class="text-muted small">{{ $post->created_at->diffForHumans() }}</p>

    {{-- show comments --}}
    @include('users.posts.contents.comment')

  </div>
