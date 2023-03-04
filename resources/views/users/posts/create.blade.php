@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" class="form-control" id="body" cols="30" rows="4">{{ old('body') }}</textarea>
            @error('body')
            <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Photo</label>
            <input type="file" class="form-control" id="image" name="image" aria-describedby="image-info">
            <div class="text-muted text-sm">Acceptable formats: jpeg, jpg, png, gif</div>
            <div class="text-muted text-sm">Max file size is 1048kb</div>
            @error('title')
            <p class="text-danger small">{{ $image }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary px-5">Post</button>
    </form>

@endsection
