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
            {{-- Header --}}
            <div>
                <i class="fa-regular fa-hashtag"></i>
                <a href="#" class="text-decoration-none text-dark">{{  }}</a>
            </div>
            {{-- Body --}}
            <div class="ms-3">
                @include('contents.title')
                @include('contents.body')
            </div>
        </div>
    </div>
</div>
@endsection
