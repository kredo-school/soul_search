<div class="bg-white mt-3 p-2 mb-0 footer">
    <form action="{{ route('messages.store', ['user' => $user]) }}" method="post" class="ms-0 ps-0" enctype="multipart/form-data">
        @csrf
        <div class="row gx-2">
            <div class="col-sm">
                <textarea name="text" id="text" rows="1" class="form-control form-control-sm col-sm" placeholder="Type your message">{{ old('text') }}</textarea>
                @error('text')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-1">
                <label for="image" class="form-label col-sm-1"><i class="fa-solid fa-circle-plus fa-2x text-secondary"></i></label>
                <input type="file" name="image" id="image" class="form-image">
                @error('image')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-1 ps-0">
                <button type="submit" class="btn btn-sm btn-orange">Send</button>
            </div>
        </div>
    </form>
</div>
