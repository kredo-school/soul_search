@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <div class="row shadow">

        <div class="col-8 p-0 border-end">
            <img class="w-100" src="{{ asset('/storage/images/' . $post->image) }}" alt="Post Image">
        </div>

    <div class="col-4 px-0 bg-white">
      <div class="card border-0">
        <div class="card-header bg-white py-3">
          <div class="row align-contents-center">
            <div class="col-auto">
              {{-- avatar --}}
              <a href="{{ route('user.show', $post->user_id) }}">
                @if ($post->user->avatar)
                  <img src="{{ asset('/storage/images/'. $post->user->avatar) }}" class="rounded-circle avatar-sm" alt="">
                @else
                  <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                @endif
              </a>
            </div>
            <div class="col ps-0 d-flex align-items-center">
              {{-- name --}}
              <a href="{{ route('user.show', $post->user_id) }}" class="text-decoration-none text-dark fw-bold">
                {{ $post->user->name }}
              </a>
            </div>
            <div class="col-auto">
              {{-- edit and delete / unfollow --}}
              <button class="btn btn-sm shadow-none" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                <i class="fa-solid fa-ellipsis"></i>
              </button>
              {{-- if the owner of the post --}}
              @if ($post->user->id == Auth::user()->id)
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li>
                    <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                      <i class="fa-regular fa-pen-to-square"></i> Edit
                    </a>
                  </li>
                  <li>
                    <a href="" class="dropdown-item text-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#delete-post-{{$post->id}}">
                      <i class="fa-regular fa-trash-can"></i> Delete
                    </a>
                  </li>
                </ul>
                @include('users.posts.modal.delete')
              {{-- if NOT the owner of the post --}}
              @else
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                {{-- if followed --}}
                @if ($post->user->isFollowedBy(Auth::user()->id))
                <li>
                  <form action="{{ route('follow.destroy', $post->user_id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm shadow-none p-0" type="submit">
                      <span class="text-danger px-2">UNFOLLOW</span>
                    </button>
                  </form>
                </li>
                {{-- if NOT followed --}}
                @else
                  <li>
                    <form action="{{ route('follow.store')}}" method="post">
                    @csrf
                      <input type="hidden" value="{{ $post->user_id }}" name="user_id">
                      <button class="btn btn-sm shadow-none p-0" type="submit">
                        <span class="text-dark px-2">FOLLOW</span>
                      </button>
                    </form>
                  </li>
                @endif
              @endif

            </div>
          </div>
        </div>

        <div class="card-body w-100">
          <div class="row aligh-items-center">

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
            <div class="col-8 text-end">
              @foreach ($post->categoryPost as $categoryPost)
                  <span class="badge bg-secondary bg-opacity-50">
                      {{ $categoryPost->category->name }}
                  </span>
              @endforeach
            </div>
          </div>
          {{-- owner and description --}}
          <a href="{{ route('user.show', $post->user_id) }}" class="text-decoration-none text-dark fw-bold">
            {{ $post->user->name }}
          </a>
          <p class="d-inline fw-light">
            {{ $post->description }}
          </p>
          <p class="text-muted small">
            {{ $post->created_at->diffForHumans() }}
          </p>

          {{-- display comments --}}
          @if ($post->comments->isNotEmpty())
            <hr>
            <ul class="list-group">
              @foreach ($post->comments as $comment)
                <li class="list-group-item border-0 p-0 mb-2">
                  <div class="">
                    <span class="fw-bold">
                      {{ $comment->user->name }}
                    </span>
                    {{ $comment->comment }}
                  </div>
                  <div class="row text-start">
                    <div class="col-auto">
                      <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                        <span class="text-muted small">
                          {{ $comment->created_at->diffForHumans() }}
                        </span>
                      @csrf
                      @method('DELETE')
                        @if (Auth::user()->id == $comment->user_id)
                          &middot;
                          <button type="submit" class="border-0 text-danger bg-transparent">Delete</button>
                        @endif
                      </form>
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
          @endif

          {{-- submit comment --}}
          <form action="{{ route('comment.store') }}" method="post">
            @csrf
            <div class="input-group">
              <input type="text" class="form-control" id="comment" name="comment" placeholder="Add a comment">
              <input type="hidden" name="post_id" value="{{ $post->id }}">
              <button type="submit" class="input-group-text border-secondary">post</button>
            </div>
          </form>

        </div>

      </div>
    </div>

  </div>

@endsection
