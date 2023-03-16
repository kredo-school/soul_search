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
                        {{-- send message --}}
                        <a href="#" class="btn btn-orange float-end ms-3">
                            send message
                        </a>

                        {{-- if followed --}}
                        @if ($user->isFollowedBy(Auth::id()))
                        <form action="{{ route('follow.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">
                            <span class="px-2">UnFollow</span>
                            </button>
                        </form>
                        {{-- if NOT followed --}}
                        @else
                        <form action="{{ route('follow.store')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                            <button class="btn btn-sm btn-secondary" type="submit">
                            <span class="px-2">Follow</span>
                            </button>
                        </form>
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
                <a href="{{ route('post.show', $post->id) }}"><img src="{{ asset('/storage/images/' . $post->image) }}" alt="Post Image" height="200"></a>
            </div>
            @endforeach

        </div>
    </div>
@endsection
