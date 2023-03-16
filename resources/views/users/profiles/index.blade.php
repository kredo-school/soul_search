@extends('layouts.app')

@section('title', 'Profile')

@section('styles')
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="card border-0 shadow-ig m-3">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-auto">

                        {{-- avatar --}}
                        @if ($user->avatar)
                            <img src="{{ asset('/storage/images/'. $user->avatar) }}" class="" alt="">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
                        @endif
                    </div>
                    <div class="col">
                        <div>
                            {{-- username --}}
                            <span class="fw-bold">{{ $user->name}}</span>
                        </div>
                        <div>
                            {{-- tags --}}
                            @forelse($tags as $tag)
                                <a href="#" class="text-decoration-none">
                                    #{{ $tag->tag }}
                                </a>
                                &nbsp;
                            @empty
                                no tag
                            @endforelse
                        </div>
                        <div class="mt-3">
                            {{-- introduction --}}
                            {{ $user->introduction }}
                        </div>
                        {{-- edit profile --}}
                        <a href="{{ route('profile.edit', Auth::id()) }}" class="btn btn-orange float-end ms-3 px-4">
                            edit
                        </a>
                        <!-- create post modal-->
                        <button class="btn btn-outline-secondary float-end" type="button"  data-bs-toggle="modal" data-bs-target="#createPostModal">
                            create post
                        </button>
                        @include('users.profiles.posts.create')

                    </div>
                </div>

            </div>
        </div>

        <hr>

        <div class="row mt-5">
            {{-- user posts --}}
            @foreach ($user->posts as $post)
            <div class="col-md-3 profile-post">
                <a href="{{ route('post.show', $post->id) }}"><img src="{{ asset('/storage/images/' . $post->image) }}" alt="Post Image" height="200"></a>
            </div>
            @endforeach

        </div>
    </div>
@endsection
