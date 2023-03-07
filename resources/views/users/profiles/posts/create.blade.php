
<div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-menu">
			<div class="modal-header">
				<h2 class="h5" id="createPostHd">Create Post</h2>
			</div>
			<div class="modal-body">
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="image" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="image" name="image" aria-describedby="image-info">
                        <div class="text-muted text-sm">Acceptable formats: jpeg, jpg, png, gif</div>
                        <div class="text-muted text-sm">Max file size is 1048kb</div>
                        @error('title')
                        <p class="text-danger small">{{ $image }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label">Message</label>
                        <textarea name="body" class="form-control" id="body" cols="30" rows="2">{{ old('body') }}</textarea>
                        @error('body')
                        <p class="text-danger small">{{ $body }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tag" class="form-label">Tags(up to 3)</label>
                        <input name="tag1" type="text" class="form-control" id="tag1" placeholder="{{ old('tag1') }}">
                        @error('tag1')
                        <p class="text-danger small">{{ $tag1 }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input name="tag2" type="text" class="form-control" id="tag2" placeholder="{{ old('tag2') }}">
                        @error('tag2')
                        <p class="text-danger small">{{ $tag2 }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input name="tag3" type="text" class="form-control" id="tag3" placeholder="{{ old('tag3') }}">
                        @error('tag3')
                        <p class="text-danger small">{{ $tag3 }}</p>
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
