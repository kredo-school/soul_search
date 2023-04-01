@extends('layouts.app')

@section('styles')
    <link href="{{ mix('css/home.css') }}" rel="stylesheet">
@endsection

@section('title', 'Home')

@section('content')
<div class="d-flex justify-content-center p-0">
    @auth
        <!-- Tags' bar -->
        <div class="col-2 bg-white tag-bar border">
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
        <!-- Chats -->
        <div class="col" style="height: 96%">
            @if ($recent_tag->isRecent())
                <!-- Header -->
                <div class="bg-white py-3 border border-top-0">
                    <i class="fa-regular fa-hashtag fa-2x ps-5"></i>
                    <a href="{{ route('chats.show', $recent_tag->tag->id) }}" class="h2 ps-1 text-decoration-none fw-bold text-dark tag-header">{{ $recent_tag->tag->name }}</a>
                </div>
                <!-- Body (Need to update to show chats a tag has) -->
                    <div class="row pt-3 chat-body">
                        @foreach ($tagged_chats as $chat)
                            <div class="chat-element">
                                <div class="col-1 pe-0 user-avatar">
                                    @include('contents.title')
                                </div>
                                <div class="col chat-content">
                                    @include('contents.body')
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Send bar -->
                <div class="pt-3 align-bottom">
                    <form action="{{ route('chat.store', $recent_tag->tag->id) }}" method="post" class="ms-0 ps-0" enctype="multipart/form-data">
                        @csrf
                        <div class="row gx-2">
                            <div class="col-sm">
                                <textarea name="chat" id="chat" rows="1" class="form-control form-control-sm col-sm" placeholder="Type your message #{{ $recent_tag->tag->name }}"></textarea>
                                @error('chat')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label for="image" title="add image" class="form-label col-sm-1"><i class="fa-solid fa-circle-plus fa-2x text-secondary"></i></label>
                                <input type="file" name="image" id="image" class="form-image">
                                @error('image')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-1 ps-0">
                                <button type="submit" class="btn btn-orange btn-send">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            @elseif ($main_tag->isMain())
                <!-- Header -->
                <div class="bg-white mt-3 mb-0 py-1 border border-top-0">
                    <i class="fa-regular fa-hashtag fa-2x ps-5"></i>
                    <a href="{{ route('chats.show', $main_tag->tag->id) }}" class="h2 ps-1 text-decoration-none fw-bold text-dark tag-header">{{ $main_tag->tag->name }}</a>
                </div>
                <!-- Body (Need to update to show chats a tag has) -->
                <div class="row pt-3 chat-body">
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
                    <form action="{{ route('chat.store', $main_tag->tag->id) }}" method="post" class="ms-0 ps-0" enctype="multipart/form-data">
                        @csrf
                        <div class="row gx-2">
                            <div class="col-sm">
                                <textarea name="chat" id="chat" rows="1" class="form-control form-control-sm col-sm" placeholder="Type your message #{{ $main_tag->tag->name }}"></textarea>
                                @error('chat')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label for="image" title="add image" class="form-label col-sm-1"><i class="fa-solid fa-circle-plus fa-2x text-secondary"></i></label>
                                <input type="file" name="image" id="image" class="form-image">
                                @error('image')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-1 ps-0">
                                <button type="submit" class="btn btn-orange btn-send">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <!-- Header -->
                <div class="bg-white mt-3 mb-0 py-1 border border-top-0">
                    <i class="fa-regular fa-hashtag fa-2x ps-5"></i>
                    <a href="{{ route('chats.show', $fav_tag->tag->id) }}" class="h2 ps-1 text-decoration-none fw-bold text-dark tag-header">{{ $fav_tag->tag->name }}</a>
                </div>
                <!-- Body (Need to update to show chats a tag has) -->
                <div class="row pt-3 chat-body">
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
                    <form action="{{ route('chat.store', $fav_tag->tag->id) }}" method="post" class="ms-0 ps-0" enctype="multipart/form-data">
                        @csrf
                        <div class="row gx-2">
                            <div class="col-sm">
                                <textarea name="chat" id="chat" rows="1" class="form-control form-control-sm col-sm" placeholder="Type your message #{{ $fav_tag->tag->name }}"></textarea>
                                @error('chat')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label for="image" title="add image" class="form-label col-sm-1"><i class="fa-solid fa-circle-plus fa-2x text-secondary"></i></label>
                                <input type="file" name="image" id="image" class="form-image">
                                @error('image')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-1 ps-0">
                                <button type="submit" class="btn btn-orange btn-send">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
