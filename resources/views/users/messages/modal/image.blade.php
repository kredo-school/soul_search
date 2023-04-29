{{-- message image modal --}}
<div class="modal fade" id="msgImageModal{{$id}}" tabindex="-1" aria-labelledby="msgImageModal{{$id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-menu">
            <div class="modal-body">
                <div class="d-flex align-items-center justify-content-center">
                    <img src="{{ asset('/storage/images/'. $image) }}" class="msg-modal-image align-middle">
                </div>
            </div>
        </div>
    </div>
</div>

