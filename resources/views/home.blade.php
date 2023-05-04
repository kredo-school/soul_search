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
            <div class="row d-flex align-items-center">
                <div class="col text-center px-5">
                    <p class="text-muted h5">Hello {{ Auth::user()->username }}!</p>
                    <p class="text-muted h6">Soul Search is an App to talk about what you wanna talk about and find your soul friend.</p>
                    <p class="text-muted h6">You can start discussions by clicking the tags on the left side.</p>
                    <p class="text-muted h6 mb-5">If you need more topics to talk about, you can create in <a href="{{ route('tags.edit', Auth::id()) }}">Edit Tags</a> page.</p>
                </div>
            </div>
        @else
            <div class="col text-center">
                <p class="text-muted h5" style="transform: translateY(39vh); line-height: 1.5em;">You don't have any tags yet.<br>When you register tags, they'll on your home.</p>
            </div>
        @endif
    </div>
@endsection
