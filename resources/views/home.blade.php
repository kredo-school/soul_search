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
                <a href="#" class="text-decoration-none text-dark">{{ $tag->tag }}</a>
            </div>
            <!-- Body -->
            <div class="ms-3">
                <div class="col-2">
                    @include('contents.title')
                </div>
                <div class="col">
                    @include('contents.body')
                </div>
            </div>
            <!-- Send bar -->
        </div>
    </div>
</div>
@endsection
