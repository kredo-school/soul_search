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
            <div class="col text-center">
                <p class="text-muted h5" style="transform: translateY(40vh)">Hello {{ Auth::user()->username }}!</p>
            </div>
        @else
            <div class="col text-center">
                <p class="text-muted h5" style="transform: translateY(39vh); line-height: 1.5em;">You don't have any tags yet.<br>When you register tags, they'll on your home.</p>
            </div>
        @endif
    </div>
@endsection
