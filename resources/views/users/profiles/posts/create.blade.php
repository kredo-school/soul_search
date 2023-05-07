{{-- modal in profile index page --}}
<div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-menu">
			<div class="modal-header">
				<h2 class="h5" id="createPostModal">Create Post</h2>
			</div>
			<div class="modal-body">
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="image" class="form-label">Photo</label>
                        <input type="file"  accept="image/*" class="form-control" id="image" name="image" aria-describedby="image-info" required>
                        <div class="text-muted text-sm">Acceptable formats: jpeg, jpg, png, gif</div>
                        <div class="text-muted text-sm">Max file size is 8MB</div>
                    </div>

                    <div class="mb-3">
                        <label for="text" class="form-label">Message</label>
                        <textarea name="text" class="form-control" id="text" cols="30" rows="2" required>{{ old('text') }}</textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-sm px-5">Post</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
