@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container mb-3 mt-3">
        <div class="row justify-content-center">
            <div class="col">
                <h1 class="text-danger">Temporary Profile Page<br><span class="text-warning">for Checking Post Page</span></h1>


				<!-- create post modal-->
				<button class="btn btn-orange" type="button"  data-bs-toggle="modal" data-bs-target="#createPostModal">
					create post
				</button>
                @include('users.profiles.posts.create')
            </div>
        </div>
    </div>
@endsection
