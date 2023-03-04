@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">
        <!-- Navbar -->
        <div class="h-100">
            @include('layouts.side')
        </div>

        <!-- Tags' bar -->
        <!-- Chats -->
        <div class="row">
            <!-- Header -->
            <div class="w-100">
                <i class="fa-regular fa-hashtag text-primary"></i>
                <a href="{{ route('tag.store', $tag->id) }}" class="text-decoration-none text-dark">{{ $tag->tag }}</a>
            </div>
            <!-- Body (Need to update to show chats the user wants) -->
            <div class="ms-3">
                <div class="col-2">
                    @include('contents.title')
                </div>
                <div class="col">
                    @include('contents.body')
                </div>
            </div>
            <!-- Send bar -->
            <form action="{{ route('chat.store') }}" method="post" class="">
                @csrf
                <div class="input-group">
                    <textarea name="chat" id="chat" rows="3" class="form-control" placeholder="Type your message #{{ $tag->tag }}">
                        {{ old('chat') }}
                    </textarea>
                    <button type="submit" class="btn">Send</button>
                </div>
                @error('chat')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </form>
        </div>
    </div>
</div>
@endsection
