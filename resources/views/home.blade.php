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
            <div class="col text-center">
                <p class="text-muted h5" style="transform: translateY(40vh)">Hello {{ Auth::user()->username }}!</p>
            </div>
        @else
            <div class="col text-center">
                <p class="text-muted h5" style="transform: translateY(39vh); line-height: 1.5em;">You don't have any tags yet.<br>When you register tags, they'll on your home.</p>
            </div>
        @endif
    </div>
@endsection
