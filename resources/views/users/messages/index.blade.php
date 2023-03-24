@extends('layouts.app')

@section('styles')
    <link href="{{ mix('css/message.css') }}" rel="stylesheet">
@endsection

@section('title', 'Send Message')

@section('content')
<div class="d-flex justify-content-center p-0">
    <!-- Users -->
    <div class="col-2 bg-white tag-bar border">
        <div class="mt-5">
            <ul class="nav nav-pills flex-column px-0">
                {{-- @foreach ($recent_tags as $tag) --}}
                @foreach($users as $user)
                    @if($user->isFollowed(Auth::id()))
                        <li class="nav-item mb-1">
                            <a href="#" class="flex-fill nav-link">
                                <span class="text-dark tag-name">{{$user->username}}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            {{-- @endforeach --}}
            </ul>
        </div>
    </div>


    <!-- Messages -->
    <div class="col" style="height: 95%">
        <!-- Header -->
        <div class="bg-white my-3 py-1 border border-top-0">
            <i class="fa-regular fa-hashtag fa-2x ps-5"></i>
            <a href="#" class="h2 ps-1 text-decoration-none fw-bold text-dark tag-header">Travel</a>
        </div>
        <!-- Body (Need to update to show chats the user wants) -->
        <div class="row mt-2 p-0 chat-body">
            <div class="col-1 mx-1 pe-0">
                @include('contents.title')
            </div>
            <div class="col ms-0 p-0">
                @include('contents.body')
            </div>
        </div>
            <!-- Send bar -->
        <div class="bg-white mt-3 mb-0">
            <form action="#" method="post" class="ms-0 ps-0">
                @csrf
                <div class="row gx-2">
                    <div class="col-sm">
                        <textarea name="chat" id="chat" rows="1" class="form-control form-control-sm col-sm" placeholder="Type your message #Travel"></textarea>
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
