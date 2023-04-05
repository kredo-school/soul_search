<div class="row">
    <div class="col pt-0 ps-2">
        <a class="shadow-none text-decoration-none float-{{$position}}" type="button" id="dropdownMenuButtonMsg{{$id}}" data-bs-toggle="dropdown">
            <img src="{{ asset('/storage/images/'. $image) }}" class="image-msg mb-2" alt="">
        </a>
        <span class="text-vsm text-muted float-{{$position}} {{$margin}}">{{$message->created_at->diffForHumans()}}</span>
        @if ($auth)
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonMsg{{$id}}">
                {{-- delete --}}
                <li>
                    <a href="" class="dropdown-item text-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteMsgModal{{$id}}">
                        <i class="fa-regular fa-trash-can"></i> Delete
                    </a>
                </li>
            </ul>
        @else
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonMsg{{$id}}">
                {{-- report --}}
                <li>
                    <a href="" class="dropdown-item text-danger" title="Report" data-bs-toggle="modal" data-bs-target="#reportMsgModal{{$id}}">
                        <i class="fa-solid fa-exclamation"></i> Report
                    </a>
                </li>
            </ul>
        @endif
    </div>
</div>
