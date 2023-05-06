{{-- chat image modal --}}
<div class="modal fade" id="chatImageModal{{$chat->id}}" tabindex="-1" aria-labelledby="chatImageModal{{$chat->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-menu modal-bg">
            <div class="modal-body">
                <div class="d-flex align-items-center justify-content-center">
                    <img src="/uploads/chats/{{ $chat->image }}" class="chat-modal-image align-middle">
                </div>
            </div>
        </div>
    </div>
</div>

