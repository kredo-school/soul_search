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
        <div class="col-2 bg-white tag-bar border-start border-end">
            <div class="mt-5">
                <p class="text-dark fw-bolder mb-1 ms-3 tag-name">Recent</p>
                <ul class="nav nav-pills flex-column px-0">
                    @foreach ($recent_tags as $recent_tag)
                        <li class="nav-item mb-1 tag-selected">
                            <a href="{{ route('chats.show', $recent_tag->tag->id) }}" class="flex-fill nav-link">
                                <i class="fa-regular fa-hashtag"></i>
                                <span class="text-dark tag-name">{{ $recent_tag->tag->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-5">
                <p class="text-dark fw-bolder mb-1 ms-3 tag-name">Main</p>
                <ul class="nav nav-pills flex-column px-0">
                    @foreach ($main_tags as $main_tag)
                        <li class="nav-item mb-1 tag-selected">
                            <a href="{{ route('chats.show', $main_tag->tag->id) }}" class="flex-fill nav-link">
                                <i class="fa-regular fa-hashtag"></i>
                                <span class="text-dark tag-name">{{ $main_tag->tag->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-5">
                <p class="text-dark fw-bolder mb-1 ms-3 tag-name">Fav</p>
                <ul class="nav nav-pills flex-column px-0">
                    @foreach ($fav_tags as $fav_tag)
                        <li class="nav-item mb-1 tag-selected">
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
        <div class="col p-0 chat-view">
            <!-- Header -->
            <div class="bg-white py-3 border-bottom">
                <i class="fa-regular fa-hashtag fa-2x ps-5"></i>
                <a href="{{ route('chats.show', $tag->id) }}" class="h2 ps-1 text-decoration-none fw-bold tag-name">{{ $tag->name }}</a>
            </div>
            <!-- Body (Need to update to show chats a tag has) -->
            <div class="row pt-0 chat-body" id="chbody">
                @foreach ($tagged_chats as $chat)
                    <div class="chat-element">
                        <div class="user-avatar">
                            @include('contents.title')
                        </div>
                        <div class="chat-content">
                            @include('contents.body')
                        </div>
                    </div>
                    @endforeach
                </div>
            <!-- Form -->
            <div class="pt-2 pb-0 align-bottom chat-form">
                <form action="{{ route('chats.store', $tag->id) }}" method="post" class="ms-0 ps-0 pt-1" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-2">
                        <div class="col">
                            <textarea name="chat" id="chat" rows="1" class="form-control form-control-sm col-sm auto-adjust" placeholder="Type your message #{{ $tag->name }}"></textarea>
                            @error('chat')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-auto">
                            <label for="image" title="add image" class="form-label col-sm-1"><i class="fa-solid fa-circle-plus fa-2x text-secondary"></i></label>
                            <input type="file" name="image" id="image" class="form-image">
                            @error('image')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-orange btn-sm btn-send">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="text-center">
            <p class="text-muted" style="transform: translateY(40vh)">You don't have any tags yet.</p>
        </div>
    @endif
</div>

{{-- javascript to resize textarea --}}
<script>
    document.querySelectorAll(".auto-adjust").forEach(function(){
        this.addEventListener('keydown',function(e){
            e.srcElement.style.height = 0
            e.srcElement.style.height = e.srcElement.scrollHeight+"px"

            let h = e.srcElement.scrollHeight
            let ch = document.documentElement.clientHeight
            document.getElementById('chbody').style.height = ch-h-100+"px"
        })
    })
    window.addEventListener('resize', function(){
        let h = e.srcElement.scrollHeight
        let ch = document.documentElement.clientHeight
        document.getElementById('chbody').style.height = ch-h-100+"px"
    })
</script>

@endsection
