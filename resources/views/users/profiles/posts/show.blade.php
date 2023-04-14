@extends('layouts.app')

@section('styles')
    <link href="{{ mix('css/post.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script>
        window.addEventListener('resize', function(){
            const smWindowSize = 1000; //window width for change css
            const photo = document.getElementById('postPhoto');
            const text  = document.getElementById('postText');
            if (window.innerWidth < smWindowSize){ // width < 1000
                photo.className = "photo-container"; // change class name
                text.className  = "";
            } else { // width >= 1000
                photo.className = "col-8 p-0 photo-container";
                text.className  = "col-4 p-0";
            }
        })
    </script>
@endsection

@section('title', 'Post')

@section('content')
    <div class="row w-100">

        <div class="col-8 p-0 photo-container" id="postPhoto">
            @include('users.profiles.posts.contents.photo')
        </div>
        <div class="col-4 p-0" id="postText">
            @include('users.profiles.posts.contents.body')
            @include('users.profiles.posts.contents.comment')
        </div>
    </div>

@endsection
