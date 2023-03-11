@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="row w-100">

        <div class="col-8 p-0">
            @include('users.profiles.posts.contents.photo')
        </div>
        <div class="col-4 p-0">
            <div class="container">
                <h2 class="h5 mt-3">Edit Post</h2>

                <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
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
                        <label for="body" class="form-label">Message</label>
                        <textarea name="body" class="form-control" id="body" cols="30" rows="2">{{ old('body', $post->body) }}</textarea>
                        @error('body')
                            <p class="text-danger small">{{ $body }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tag" class="form-label">Tags(up to 3)</label>
                        @foreach ($tags as $tag)
                            <input name="tag[]" type="text" class="form-control" id="tag[]" value="{{ old('tag[]', $tag->tag) }}">
                            <input name="old_tag_id[]" type="hidden" value="{{ $tag->id }}">
                        @endforeach
                        @if ($tag_count < 3)
                            @for ($i = 0; $i < 3 - $tag_count; $i++)
                                <input name="tag[]" type="text" class="form-control" id="tag[]" value="{{ old('tag[]') }}">
                            @endfor
                        @endif
                        <input name="old_tag_count" type="hidden" value="{{ $tag_count }}">

                    </div>
                    <button type="submit" class="btn btn-sm btn-warning px-3">Update</button>
                    <a type="button" href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-secondary px-3">Cancel</a>

                </form>

            </div>

        </div>
    </div>

@endsection
