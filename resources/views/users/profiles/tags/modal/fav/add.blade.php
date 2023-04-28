{{-- modal in profile edit page --}}
<div class="modal fade" id="addFavModal" tabindex="-1" aria-labelledby="addFavModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-menu">
			<div class="modal-body">
				<h2 class="h5" id="addFavModal">Add Favorite Tag</h2>
                <form action="{{ route('tags.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                        <input type="hidden" name="category" value="favorite">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-orange btn-sm px-5">Add</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
