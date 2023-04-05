{{-- message edit modal --}}
<div class="modal fade" id="editMsgModal{{$message->id}}" tabindex="-1" aria-labelledby="editMsgModal{{$message->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-menu">
            <div class="modal-header">
                <h2 class="modal-title" id="editMsgModal{{$message->id}}">Edit Message</h2>
            </div>
            <div class="modal-body">
                <div>

                    <form action="{{ route('messages.update', ['user' => $user->id, 'message' => $message->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row gx-2 mb-2">
                            <div class="col-sm">
                                <textarea name="text" id="text" rows="1" class="form-control form-control-sm col-sm">{{ old('text', $message->text) }}</textarea>
                                @error('text')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-warning px-3">Update</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

