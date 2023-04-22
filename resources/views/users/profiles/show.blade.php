@extends('layouts.app')

@section('title', 'Profile')

@section('styles')
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="profile-container mx-auto">
        <div class="card border-0 shadow p-2 mt-3 me-1">
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
                            @forelse($main_tags as $main_tag)
                                <a href="#" class="text-decoration-none">
                                    #{{ $main_tag->tag->name }}
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
                            {{-- error message from create modal --}}
                            @error('image')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                            @error('text')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror

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
                            @if ($user->followedBy(Auth::id()))
                                <form action="{{ route('follows.destroy', ['user' => $user->id, 'follow' => $user->follows()->where('following_id', Auth::id())->first()->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger float-end" type="submit">
                                    <span class="px-2">unfollow</span>
                                    </button>
                                </form>
                            {{-- if NOT followed --}}
                            @else
                                <form action="{{ route('follows.store', ['user' => $user->id]) }}" method="post">
                                    @csrf
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

        {{-- user posts --}}
        <div class="mx-auto mt-4">
            @php
                $count = 0;
            @endphp
            @foreach ($user->posts as $post)
                @if ($count % 4 == 0)
            <div class="row mt-1">
                @endif
                <div class="col-3">
                    <a href="{{ route('posts.show', $post->id) }}"><img src="{{ asset('/storage/images/' . $post->image) }}" alt="Post Image" class="profile-post"></a>
                </div>
                @if ($count % 4 == 3)
            </div>
                @endif
                @php
                    $count++;
                @endphp
            @endforeach
        </div>

    </div>
@endsection
