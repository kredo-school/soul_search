@extends('layouts.app')

@section('title', 'Profile')

@section('styles')
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="profile-container mx-auto">
    <div class="card border-0 shadow" id="profile-box">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-auto mt-1">

                    {{-- avatar --}}
                    @if ($user->avatar)
                        <img src="{{ $user->avatar }}" class="avatar-lg rounded-circle" alt="">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
                    @endif
                </div>
                <div class="col">
                    {{-- username --}}
                    <div class="row">
                        <div class="col">
                            <span class="fw-bold">{{ $user->username }}</span>
                        </div>

                        {{-- 'create post' and 'edit' / 'follow/unfollow' and 'send message' buttons --}}
                        <div class="col">
                            {{-- check if the login user's profile or not --}}
                            @if($user->id === Auth::id())
                                {{-- edit profile --}}
                                <a href="{{ route('profiles.edit', $user->id) }}" class="btn btn-orange float-end ms-2 mt-2 px-4">
                                    Edit
                                </a>
                                <!-- create post modal-->
                                <button class="btn btn-outline-secondary float-end mt-2" type="button"  data-bs-toggle="modal" data-bs-target="#createPostModal">
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
                                <button class="btn float-end shadow-none ms-2 mt-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
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
                                <a href="{{ route('messages.show', ['user' => $user->id]) }}" class="btn btn-orange btn-sm float-end ms-2 mt-2">
                                    send message
                                </a>
                                {{-- if followed --}}
                                @if ($user->followedBy(Auth::id()))
                                    <form action="{{ route('follows.destroy', ['user' => $user->id, 'follow' => $user->follows()->where('following_id', Auth::id())->first()->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm float-end mt-2" type="submit">
                                        <span class="px-2">unfollow</span>
                                        </button>
                                    </form>
                                {{-- if NOT followed --}}
                                @else
                                    <form action="{{ route('follows.store', ['user' => $user->id]) }}" method="post">
                                        @csrf
                                        <button class="btn btn-secondary btn-sm float-end mt-2" type="submit">
                                        <span class="px-2">follow</span>
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>

                    {{-- main tags --}}
                    <div>
                        main tags:
                    </div>
                    <div>
                        @forelse($main_tags as $main_tag)
                            <a href="{{ route('chats.show', $main_tag->tag->id) }}" class="text-decoration-none">
                                #{{ $main_tag->tag->name }}
                            </a>
                            &nbsp;
                        @empty
                            no main tag
                        @endforelse
                    </div>

                    {{-- favorite tags --}}
                    <div>
                        favorite tags:
                    </div>
                    <div>
                        @foreach($fav_tags as $fav_tag)
                            <a href="{{ route('chats.show', $fav_tag->tag->id) }}" class="text-decoration-none">
                                #{{ $fav_tag->tag->name }}
                            </a>
                            &nbsp;
                        @endforeach
                    </div>

                    {{-- introduction --}}
                    <div class="my-3">
                        {{ $user->introduction }}
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- user posts --}}
    <div class="mx-auto mt-4 profile-post-container">
        @php
            $count = 0;
            $posts = $user->posts;
        @endphp
        @foreach ($posts as $post)
            @if ($count % 4 == 0)
        <div class="row mt-1">
            @endif
            <div class="col-3">
                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none">
                    <img src="{{ $post->image }}" alt="Post Image" class="profile-post" id="post-img{{$count}}">
                </a>
            </div>
            @if ($count % 4 == 3 or $post == end($posts))
        </div>
            @endif
            @php
                $count++;
            @endphp
        @endforeach
    </div>
</div>

{{-- javascript to set 'send message bar' width --}}
<script>
    let profile_w = document.getElementById('profile-box').clientWidth;
    if(profile_w < 816){
        @for ($i=0; $i<$count; $i++)
            window.document.getElementById('post-img{{$i}}').style.height = profile_w / 4 + 'px';
        @endfor
    }
    window.addEventListener('resize', function(){
        profile_w = document.getElementById('profile-box').clientWidth;
        if(profile_w < 816){
            @for ($i=0; $i<$count; $i++)
                window.document.getElementById('post-img{{$i}}').style.height = profile_w / 4 + 'px';
            @endfor
        }
    })
</script>

@endsection
