@extends('layouts.app')

@section('styles')
    <link href="{{ mix('css/post.css') }}" rel="stylesheet">
@endsection

@section('title', 'Profile')

@section('content')
    <div class="row w-100">

        <div class="col-8 p-0">
            @include('users.profiles.posts.contents.photo')
        </div>
        <div class="col-4 p-0">
            <div class="container">
                <h2 class="h5 mt-3">Edit Post</h2>

                <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="image" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="image" name="image" aria-describedby="image-info">
                        <div class="text-muted text-sm">Acceptable formats: jpeg, jpg, png, gif</div>
                        <div class="text-muted text-sm">Max file size is 1048kb</div>
                        @error('image')
                            <p class="text-danger small">{{ $image }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="text" class="form-label">Message</label>
                        <textarea name="text" class="form-control" id="text" cols="30" rows="2">{{ old('text', $post->text) }}</textarea>
                        @error('text')
                            <p class="text-danger small">{{ $text }}</p>
                        @enderror
                    </div>

                    @foreach ($old_tag_ids as $old_tag_id)
                        <input type="hidden" name="old_tag_ids[]" value="{{ $old_tag_id }}">
                    @endforeach

                    <button type="submit" class="btn btn-sm btn-warning px-3">Update</button>
                    <a type="button" href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-secondary px-3">Cancel</a>

                </form>

            </div>

        </div>
    </div>

@endsection
