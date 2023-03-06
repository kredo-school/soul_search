@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <div class="row w-100">

        <div class="col-8 p-0">
            @include('users.posts.contents.photo')
        </div>
        <div class="col-4 p-0">
            @include('users.posts.contents.body')
            @include('users.posts.contents.comment')
        </div>
    </div>

@endsection
