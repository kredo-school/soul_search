@extends('layouts.app')

@section('styles')
    <link href="{{ mix('css/home.css') }}" rel="stylesheet">
@endsection

@section('title', 'Home')

@section('content')
    <div class="d-flex justify-content-start p-0">
        @if(Auth::user()->userTag()->exists())
        @auth
        <!-- Tags' bar -->
        <div class="col-2 ps-1 bg-white tag-bar border">
            <div class="mt-5">
                <p class="text-dark fw-bold mb-1 ms-3 tag-name">Recent</p>
                <ul class="nav nav-pills flex-column px-0">
                    @foreach ($recent_tags as $recent_tag)
                        <li class="nav-item mb-1">
                            <a href="{{ route('chats.show', $recent_tag->tag->id) }}" class="flex-fill nav-link">
                                <i class="fa-regular fa-hashtag"></i>
                                <span class="text-dark tag-name">{{ $recent_tag->tag->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-5">
                <p class="text-dark fw-bold mb-1 ms-3 tag-name">Main</p>
                <ul class="nav nav-pills flex-column px-0">
                    @foreach ($main_tags as $main_tag)
                        <li class="nav-item mb-1">
                            <a href="{{ route('chats.show', $main_tag->tag->id) }}" class="flex-fill nav-link">
                                <i class="fa-regular fa-hashtag"></i>
                                <span class="text-dark tag-name">{{ $main_tag->tag->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-5">
                <p class="text-dark fw-bold mb-1 ms-3 tag-name">Fav</p>
                <ul class="nav nav-pills flex-column px-0">
                    @foreach ($fav_tags as $fav_tag)
                        <li class="nav-item mb-1">
                            <a href="{{ route('chats.show', $fav_tag->tag->id) }}" class="flex-fill nav-link">
                                <i class="fa-regular fa-hashtag"></i>
                                <span class="text-dark tag-name">{{ $fav_tag->tag->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endauth
        <!-- Home for a specific user -->
        <div class="col px-5 pt-4">
            <div class="card home-card justify-content-center">
                <div class="card-header bg-white border">
                    <div class="row align-items-center">
                        <p class="text-muted h4 pt-3">Hello {{ Auth::user()->username }}!</p>
                    </div>
                </div>
                <!-- Show Close Users-->
                @if ($close_users)
                @foreach($close_users as $user)
                    <a href="{{ route('messages.show', $user->id) }}" class="text-decoration-none">
                        <div class="card-body border border-1">
                            <div class="row justify-content-center">
                                <div class="col-auto home-user-avatar">
                                    @if ($user->avatar)
                                        <img src="{{ asset('/storage/avatars/'. $user->avatar) }}" class="rounded-circle user-avatar" alt="{{ $user->avatar }}">
                                    @else
                                        <i class="fa-solid fa-circle-user fa-4x text-secondary"></i>
                                    @endif
                                </div>
                                <div class="col ps-0 pt-1">
                                    <div class="row justify-content-center">
                                        <div>
                                            <span class="h5 fw-bold tag-name">
                                                {{ $user->username }}
                                            </span>
                                        </div>
                                        <div>
                                            @if ($user->is_active)
                                                <p class="chat-text"><i class="fa-solid fa-globe text-info"></i>&nbsp;Online</p>
                                            @else
                                                <p class="chat-text"><i class="fa-solid fa-circle-xmark text-danger"></i>&nbsp;Offline</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 pt-3 me-3">
                                    <i class="fa-solid fa-comment-dots fa-2x" title="message"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                @endif
            </div>
        @else
            <div class="col text-center">
                <p class="text-muted h5" style="transform: translateY(39vh); line-height: 1.5em;">You don't have any tags yet.<br>When you register tags, they'll on your home.</p>
            </div>
        @endif
        </div>
    </div>
@endsection
