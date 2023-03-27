<div class="col ms-0 p-0">
    <div class="container p-0">
        @forelse ($messages as $message)
            <div class="row">
                <div class="col pt-0 ps-2">
                    @if($message->sender_id === Auth::id())
                        <a class="shadow-none text-decoration-none float-end" type="button" id="dropdownMenuButtonMsg{{$message->id}}" data-bs-toggle="dropdown">
                            @if($message->text)
                                <span class="btn btn-sm btn-orange px-3 rounded-pill mb-2">{{ $message->text }}</span>
                            @else
                                <img src="{{ asset('/storage/images/'. $message->image) }}" class="image-msg mb-2" alt="">
                            @endif
                        </a>
                        {{-- edit and delete --}}
                        <ul class="dropdown-menu float-end" aria-labelledby="dropdownMenuButtonMsg{{$message->id}}">
                            <li>
                                <a href="#" class="dropdown-item">
                                    <i class="fa-regular fa-pen-to-square"></i> Edit
                                </a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item text-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteMsgModal{{$message->id}}">
                                    <i class="fa-regular fa-trash-can"></i> Delete
                                </a>
                            </li>
                        </ul>
                        {{-- delete modal --}}
                        @include('users.messages.modal.delete')
                    @else
                        @if ($user->avatar)
                            <img src="{{ asset('/storage/avatars/'. $user->avatar) }}" class="rounded-circle avatar-msg me-1" alt="">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-msg me-1"></i>
                        @endif
                        @if($message->text)
                            <span class="btn btn-sm btn-secondary px-3 rounded-pill mb-2">{{ $message->text }}</span>
                        @else
                        <img src="{{ asset('/storage/images/'. $message->image) }}" class="image-msg mb-2" alt="">
                        @endif
                        {{-- report --}}
                    @endif
                </div>
            </div>
        @empty

        @endforelse


    </div>
</div>
