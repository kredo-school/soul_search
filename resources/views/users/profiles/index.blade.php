@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container mb-3 mt-3">
        <div class="row justify-content-center">
            <div class="col">
                @include('users.profiles.profile')
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                @include('users.profiles.posts')
            </div>
        </div>
    </div>
@endsection
