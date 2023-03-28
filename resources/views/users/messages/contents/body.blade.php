<div class="col ms-0 p-0">
    <div class="container p-0">
        @forelse ($messages as $message)
            <div class="row">
                <div class="col pt-0 ps-2">
                    @if($message->sender_id === Auth::id())
                        <a class="shadow-none text-decoration-none float-end" type="button" id="dropdownMenuButtonMsg{{$message->id}}" data-bs-toggle="dropdown">
                            @if($message->text)
                                @if($message->updated_at != $message->created_at)
                                    <span class="text-muted text-sm">edited</span>
                                @endif
                                <span class="btn btn-sm btn-orange px-3 rounded-pill mb-2">{{ $message->text }}</span>
                            @else
                                <img src="{{ asset('/storage/images/'. $message->image) }}" class="image-msg mb-2" alt="">
                            @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonMsg{{$message->id}}">
                            {{-- edit (only for text) --}}
                            @if($message->text)
                                <li>
                                    <a href="" class="dropdown-item text-dark" title="Edit" data-bs-toggle="modal" data-bs-target="#editMsgModal{{$message->id}}">
                                        <i class="fa-regular fa-pen-to-square"></i> Edit
                                    </a>
                                </li>
                            @endif
                            {{-- delete --}}
                            <li>
                                <a href="" class="dropdown-item text-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteMsgModal{{$message->id}}">
                                    <i class="fa-regular fa-trash-can"></i> Delete
                                </a>
                            </li>
                        </ul>
                    @else
                        @if ($user->avatar)
                            <img src="{{ asset('/storage/avatars/'. $user->avatar) }}" class="rounded-circle avatar-msg me-1" alt="">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-msg me-1"></i>
                        @endif
                        <a class="shadow-none text-decoration-none" type="button" id="dropdownMenuButtonMsg{{$message->id}}" data-bs-toggle="dropdown">
                            @if($message->text)
                                <span class="btn btn-sm btn-secondary px-3 rounded-pill mb-2">{{ $message->text }}</span>
                                @if($message->updated_at != $message->created_at)
                                    <span class="text-muted text-sm">edited</span>
                                @endif
                            @else
                            <img src="{{ asset('/storage/images/'. $message->image) }}" class="image-msg mb-2" alt="">
                            @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonMsg{{$message->id}}">
                            {{-- report --}}
                            <li>
                                <a href="" class="dropdown-item text-danger" title="Report" data-bs-toggle="modal" data-bs-target="#reportMsgModal{{$message->id}}">
                                    <i class="fa-solid fa-exclamation"></i> Report
                                </a>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
            {{-- edit modal --}}
            @include('users.messages.modal.edit')
            {{-- delete modal --}}
            @include('users.messages.modal.delete')
            {{-- report modal --}}
            @include('users.messages.modal.reportMsg')
        @empty

        @endforelse


    </div>
</div>
