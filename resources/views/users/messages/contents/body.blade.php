{{-- message display --}}
<div class="col ms-0 p-0">
    <div class="container p-0">
        @forelse ($messages as $message)
            <div class="row">
                <div class="col pt-0 ps-2">
                    @if($message->sender_id === Auth::id())
                        <a class="shadow-none text-decoration-none float-end" type="button" id="dropdownMenuButtonMsg{{$message->id}}" data-bs-toggle="dropdown">
                            <span class="text-sm text-muted">{{$message->created_at->diffForHumans()}}</span>
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
                            <span class="text-sm text-muted">{{$message->created_at->diffForHumans()}}</span>
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

        {{-- error messages from "send message" below --}}
        @error('text')
            <div class="text-danger small position-absolute bottom-0 end-0">
                <span class="me-4">{{ $message }}</span>
            </div>
        @enderror
        @error('image')
            <div class="text-danger small position-absolute bottom-0 end-0">
                <span class="me-4">{{ $message }}</span>
            </div>
        @enderror

        {{-- image preview from "send message" below --}}
        <figure id="figure" style="display: none" class="position-absolute bottom-0 end-0">
            <figcaption class="me-4">Image Preview</figcaption>
            <img src="" alt="your image" class="me-3" id="figureImage" style="height: 100px">
        </figure>
    </div>
</div>



{{-- send message --}}
<div class="bg-white mt-3 p-2 mb-0 footer">
    <form action="{{ route('messages.store', ['user' => $user]) }}" method="post" class="ms-0 ps-0" enctype="multipart/form-data" runat="server">
        @csrf
        <div class="row gx-2">
            <div class="col-sm">
                <textarea name="text" id="text" rows="1" class="form-control form-control-sm col-sm" placeholder="Type your message">{{ old('text') }}</textarea>
            </div>
            <div class="col-sm-1">
                <label for="image" class="form-label col-sm-1"><i class="fa-solid fa-circle-plus fa-2x text-secondary"></i></label>
                <input accept="image/*" type="file" name="image" id="image" class="form-image">
            </div>
            <div class="col-sm-1 ps-0">
                <button type="submit" class="btn btn-sm btn-orange">Send</button>
            </div>
        </div>
    </form>
</div>

<script>
    function main () {
        const input = document.querySelector('#image')
        const figure = document.querySelector('#figure')
        const figureImage = document.querySelector('#figureImage')

        input.addEventListener('change', (event) => { // <1>
            const [file] = event.target.files

            if (file) {
            figureImage.setAttribute('src', URL.createObjectURL(file))
            figure.style.display = 'block'
            } else {
            figure.style.display = 'none'
            }
        })
    }
    main()
</script>
