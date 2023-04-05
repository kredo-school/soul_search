<div class="row">
    <div class="col pt-0 ps-2">
        <a class="shadow-none text-decoration-none float-{{$position}}" type="button" id="dropdownMenuButtonMsg{{$id}}" data-bs-toggle="dropdown">
            @if($message->updated_at != $message->created_at)
                <div class="text-muted text-sm">edited</div>
            @endif
            <span class="btn btn-sm btn-{{$color}} px-3 rounded-pill mb-2">{{$text}}</span>
        </a>
        <span class="text-time text-muted float-{{$position}} {{$margin}}">{{$message->created_at->diffForHumans()}}</span>
        @if($auth)
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonMsg{{$id}}">
                {{-- edit --}}
                <li>
                    <a href="" class="dropdown-item text-dark" title="Edit" data-bs-toggle="modal" data-bs-target="#editMsgModal{{$id}}">
                        <i class="fa-regular fa-pen-to-square"></i> Edit
                    </a>
                </li>
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
