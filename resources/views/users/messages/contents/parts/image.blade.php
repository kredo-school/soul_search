<div class="row">
    <div class="col pt-0 ps-2">
        <a class="shadow-none text-decoration-none float-{{$position}}" type="button" id="dropdownMenuButtonMsg{{$id}}{{$modal}}" data-bs-toggle="dropdown">
            <img src="{{ asset('/storage/images/'. $image) }}" class="image-msg mb-2" alt="">
        </a>
        <span class="text-vsm text-muted float-{{$position}} {{$margin}}">{{$user_message->created_at->diffForHumans()}}</span>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonMsg{{$id}}{{$modal}}">
            <li>
                <a href="" class="dropdown-item text-warning" title="Image" data-bs-toggle="modal" data-bs-target="#msgImageModal{{$id}}">
                    <i class="fa-solid fa-magnifying-glass"></i> Zoom
                </a>
            </li>
            @if ($auth)
                {{-- delete --}}
                <li>
                    <a href="" class="dropdown-item text-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteMsgModal{{$id}}{{$modal}}">
                        <i class="fa-regular fa-trash-can"></i> Delete
                    </a>
                </li>
            @else
                {{-- report --}}
                <li>
                    <a href="" class="dropdown-item text-danger" title="Report" data-bs-toggle="modal" data-bs-target="#reportMsgModal{{$id}}{{$modal}}">
                        <i class="fa-solid fa-circle-exclamation"></i> Report
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
