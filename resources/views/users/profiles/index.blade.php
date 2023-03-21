@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container mb-3 mt-3">
        <div class="row justify-content-center">
            <div class="col">
                <h1 class="text-danger">Temporary Profile Page<br><span class="text-warning">for Checking Post Page</span></h1>

				<!-- create post modal-->
				<button class="btn btn-warning" type="button"  data-bs-toggle="modal" data-bs-target="#createPostModal">
					create post
				</button>
                @include('users.profiles.posts.create')

                <br>
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-md-3 profile-post">
                        <a href="{{ route('posts.show', $post->id) }}"><img src="{{ asset('/storage/images/' . $post->image) }}" alt="Post Image" height="200"></a>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
