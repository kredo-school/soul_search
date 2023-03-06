@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<div class="container mb-3 mt-3">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-0">
                <h1 class="text-center mt-4 text-muted">Create Post</h1>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10">

                            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="body" class="form-label">Message</label>
                                    <textarea name="body" class="form-control" id="body" cols="30" rows="3">{{ old('body') }}</textarea>
                                    @error('body')
                                    <p class="text-danger small">{{ $body }}</p>
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

                                <div class="text-center">
                                    <button type="submit" class="btn btn-orange btn-sm px-5">Post</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
