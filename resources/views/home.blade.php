@extends('layouts.app')

@section('styles')
    <link href="{{ mix('css/home.css') }}" rel="stylesheet">
@endsection

@section('title', 'Home')

@section('content')
    <div class="d-flex justify-content-start p-0">
        @if(Auth::user()->userTag()->exists())

            {{-- tag bar --}}
            @include('contents.tagbar')

            <!-- Home for a specific user -->
            <div class="row">
                <div class="col text-center px-3 mt-5 home-text">
                    <p class="h5 mb-4">Hello {{ Auth::user()->username }}!</p>
                    <p class="h6">Soul Search is an App to talk about what you wanna talk about and find your soul friend.</p>
                    <p class="h6 mb-4">You can start discussions by clicking the tags on the left side.</p>
                    <p class="h6">If you need more topics to talk about, you can create at <a href="{{ route('tags.edit', Auth::id()) }}">Edit Tags</a> page.</p>
                    <p class="h6 mb-4">You can alse create topics by setting #hashtags in "create post" text in <a href="{{ route('profiles.index') }}">Edit Profile</a> page.</p>
                    <p class="h6 mb-4">If you have any questions or feedbacks, please feel free to <a href="{{ route('contact.index') }}">Contact Us</a>.</p>
                    <img src="{{ asset('images/logo.svg')}}">
                </div>
            </div>
        @else
            <div class="col text-center">
                <p class="text-muted h5" style="transform: translateY(39vh); line-height: 1.5em;">You don't have any tags yet.<br>When you register tags, they'll on your home.</p>
            </div>
        @endif
    </div>
@endsection
