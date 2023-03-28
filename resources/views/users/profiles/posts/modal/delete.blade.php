{{-- post delete modal --}}
<div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-menu">
			<div class="modal-header">
				<h2 class="modal-title" id="deletePostModal">Delete Post</h2>
			</div>
			<div class="modal-body">
                <div>
                    Are you sure to delete the post ?
                </div>

                <div>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-triangle-exclamation"></i> Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
