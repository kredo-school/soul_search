@extends('layouts.app')

@section('styles')
    <link href="{{ mix('css/post.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script>
        document.documentElement.clientWidth
    </script>
@endsection

@section('title', 'Post')

@section('content')
    <div class="row w-100">

        <div class="col-8 p-0">
            @include('users.profiles.posts.contents.photo')
        </div>
        <div class="col-4 p-0">
            @include('users.profiles.posts.contents.body')
            @include('users.profiles.posts.contents.comment')
        </div>
    </div>

@endsection
