{{-- message delete modal --}}
<div class="modal fade" id="deleteMsgModal{{$id}}{{$modal}}" tabindex="-1" aria-labelledby="deleteMsgModal{{$id}}{{$modal}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-menu">
            {{-- if data is text --}}
            @if($text_data)
                @php
                    $displayA = 'Message';
                    $displayB = 'message';
                @endphp
            {{-- if data is image --}}
            @else
                @php
                    $displayA = 'Image';
                    $displayB = 'image';
                @endphp
            @endif

            <div class="modal-header">
                <h2 class="modal-title" id="deleteMsgModal{{$id}}{{$modal}}">Delete {{$displayA}}</h2>
            </div>

            <div class="modal-body">
                <div>
                    Are you sure to delete the {{$displayB}}?
                </div>

                <div>
                    @if($both_data)
                        <form action="{{ route('messages.update', ['user' => $user->id, 'message' => $message->id]) }}" method="post" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="text_data" value="{{$text_data}}">
                            <input type="hidden" name="media_id" value="{{$media_id}}">
                            <input type="hidden" name="remove_data" value="remove">
                    @else
                        <form action="{{ route('messages.destroy', ['user' => $user->id, 'message' => $message->id]) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                    @endif
                            <input type="hidden" name="image" value="{{$image}}">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-triangle-exclamation"></i> Delete</button>
                        </form>
                </div>

            </div>
        </div>
    </div>
</div>

