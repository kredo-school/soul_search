@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">
        {{-- Navbar --}}
        <div class="h-100">
            @include('layouts.side')
        </div>

        {{-- Tags --}}
        {{-- Chats --}}
        <div class="row">
            {{-- Title --}}
            <div>
                <i class="fa-regular fa-hashtag"></i>
                <a href="#" class="text-decoration-none text-dark">{{  }}</a>
            </div>
            {{-- Body --}}
            <div class="ms-3">
                {{-- @include(chats.title) --}}
                {{-- @include(chats.body) --}}
            </div>
        </div>
    </div>
</div>
@endsection
