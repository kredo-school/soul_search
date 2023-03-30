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
                            <img src="{{ asset('/storage/avatars/'. $user->avatar) }}" class="avatar-lg rounded-circle" alt="">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
                        @endif
                    </div>
                    <div class="col">
                        <div>
                            {{-- username --}}
                            <span class="fw-bold">{{ $user->username}}</span>
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

                        {{-- check if the login user's profile or not --}}
                        @if($user->id === Auth::id())
                            {{-- edit profile --}}
                            <a href="{{ route('profiles.edit', $user->id) }}" class="btn btn-orange float-end ms-3 px-4">
                                Edit
                            </a>
                            <!-- create post modal-->
                            <button class="btn btn-outline-secondary float-end" type="button"  data-bs-toggle="modal" data-bs-target="#createPostModal">
                                create post
                            </button>
                            @include('users.profiles.posts.create')

                        @else
                            {{-- report --}}
                            <button class="btn float-end shadow-none" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a href="#" class="dropdown-item text-danger" title="Report" data-bs-toggle="modal" data-bs-target="#reportUserModal">
                                        <i class="fa-solid fa-exclamation"></i> Report
                                    </a>
                                </li>
                            </ul>
                            @include('users.profiles.modal.report')
                            {{-- send message --}}
                            <a href="{{ route('messages.show', ['user' => $user]) }}" class="btn btn-orange float-end ms-3">
                                send message
                            </a>
                            {{-- if followed --}}
                            @if ($user->isfollowed(Auth::id()))
                            <form action="{{ route('follows.destroy', $user->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger float-end" type="submit">
                                <span class="px-2">unfollow</span>
                                </button>
                            </form>
                            {{-- if NOT followed --}}
                            @else
                            <form action="{{ route('follows.store') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $user->id }}" name="user_id">
                                <button class="btn btn-secondary float-end" type="submit">
                                <span class="px-2">follow</span>
                                </button>
                            </form>
                            @endif
                        @endif

                    </div>
                </div>

            </div>
        </div>

        <hr>

        <div class="row mt-5">
            {{-- user posts --}}
            @foreach ($user->posts as $post)
            <div class="col-md-3 profile-post">
                <a href="{{ route('posts.show', $post->id) }}"><img src="{{ asset('/storage/images/' . $post->image) }}" alt="Post Image" height="200"></a>
            </div>
            @endforeach

        </div>
    </div>
@endsection
