@extends('layouts.app')

@section('styles')
    <link href="{{ mix('css/home.css') }}" rel="stylesheet">
@endsection

@section('title', 'Home')

@section('content')
<div class="d-flex justify-content-center p-0">
    <!-- Tags bar -->
    <div class="col-2 bg-white tag-bar border">
        <div class="mt-5">
            <p class="text-dark fw-bold mb-1 ms-3 tag-name">Recent</p>
            <ul class="nav nav-pills flex-column px-0">
                {{-- @foreach ($recent_tags as $tag) --}}
                <li class="nav-item mb-1">
                    <a href="#" class="flex-fill nav-link">
                        <i class="fa-regular fa-hashtag"></i>
                        <span class="text-dark tag-name">Music</span>
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="#" class="flex-fill nav-link">
                        <i class="fa-regular fa-hashtag"></i>
                        <span class="text-dark tag-name">Politics</span>
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="#" class="flex-fill nav-link">
                        <i class="fa-regular fa-hashtag"></i>
                        <span class="text-dark tag-name">Food</span>
                    </a>
                </li>
            {{-- @endforeach --}}
            </ul>
        </div>
        <div class="mt-5">
            <p class="text-dark fw-bold mb-1 ms-3 tag-name">Main</p>
            <ul class="nav nav-pills flex-column px-0">
                @foreach ($main_tags as $tag)
                    <li class="nav-item mb-1">
                        <a href="{{ route('chats.show', $tag->id) }}" class="flex-fill nav-link">
                            <i class="fa-regular fa-hashtag"></i>
                            <span class="text-dark tag-name">{{ $tag->tag }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="mt-5">
            <p class="text-dark fw-bold mb-1 ms-3 tag-name">Fav</p>
            <ul class="nav nav-pills flex-column px-0">
                @foreach ($fav_tags as $tag)
                    <li class="nav-item mb-1">
                        <a href="{{ route('chats.show', $tag->id) }}" class="flex-fill nav-link">
                            <i class="fa-regular fa-hashtag"></i>
                            <span class="text-dark tag-name">{{ $tag->tag }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- Chats -->
    <div class="col" style="height: 95%">
        <!-- Header -->
        <div class="bg-white my-3 py-1 border border-top-0">
            <i class="fa-regular fa-hashtag fa-2x ps-5"></i>
            <a href="{{ route('chats.show', $tag->id) }}" class="h2 ps-1 text-decoration-none fw-bold text-dark tag-header">{{ $tag->tag }}</a>
        </div>
        <!-- Body (Need to update to show chats a tag has) -->
            <div class="row mt-2 p-0 chat-body">
                @foreach ($tagged_chats as $chat)
                    <div class="col-1 mx-1 pe-0">
                        @include('contents.title')
                    </div>
                    <div class="col ms-0 p-0">
                        @include('contents.body')
                    </div>
                @endforeach
            </div>
            <!-- Send bar -->
        <div class="bg-white mt-3 mb-0">
            <form action="{{ route('chat.store', $tag->id) }}" method="post" class="ms-0 ps-0" enctype="multipart/form-data">
                @csrf
                <div class="row gx-2">
                    <div class="col-sm">
                        <textarea name="chat" id="chat" rows="1" class="form-control form-control-sm col-sm" placeholder="Type your message #{{ $tag->tag }}"></textarea>
                        @error('chat')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-1">
                        <label for="image" class="form-label col-sm-1"><i class="fa-solid fa-circle-plus fa-2x text-secondary"></i></label>
                        <input type="file" name="image" id="image" class="form-image">
                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-1 ps-0">
                        <button type="submit" class="btn btn-orange">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
