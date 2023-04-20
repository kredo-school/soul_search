{{-- message display --}}

<div class="row mt-2 p-0">
    <div class="col ms-0 p-0">
        <div class="message-container p-0">
            @foreach ($pivot_items as $item)
                @php
                    $user_message = $item->pivot;
                    $text         = $user_message->text;
                    $media_id     = $user_message->media_id;
                    $image        = null;
                    $id           = $user_message->id;
                    if ($media_id) {
                        $image = $media->where('id', $media_id)->first()->path;
                    }
                @endphp
                {{-- if login user's message or not --}}
                @if($user_message->sender_id === Auth::id())
                    @php
                        $position = 'end';
                        $margin   = 'me-2';
                        $color    = 'orange';
                        $auth     = true;
                    @endphp
                @else
                    @php
                        $position = 'start';
                        $margin   = 'ms-2';
                        $color    = 'secondary';
                        $auth     = false;
                    @endphp
                @endif

                {{-- data has both text and image --}}
                @if($text && $image)
                    @php
                        $both_data = true;
                        $text_data = true;
                        $modal     = '';
                    @endphp
                    {{-- message text --}}
                    @include('users.messages.contents.parts.text')

                    @if ($auth)
                        {{-- edit modal --}}
                        @include('users.messages.modal.edit')
                        {{-- delete modal --}}
                        @include('users.messages.modal.delete')
                    @else
                        {{-- report modal --}}
                        @include('users.messages.modal.reportMsg')
                    @endif

                    @php
                        $text_data = false;
                        $modal     = 'second'; // to differentiate dorpdown id and modal id
                    @endphp

                    {{-- message image --}}
                    @include('users.messages.contents.parts.image')

                {{-- data has only text --}}
                @elseif($text)
                    @php
                        $both_data = false;
                        $text_data = true;
                        $modal     = '';
                    @endphp
                    {{-- message text --}}
                    @include('users.messages.contents.parts.text')

                {{-- data has only image --}}
                @elseif($image)
                    @php
                        $both_data = false;
                        $text_data = false;
                        $modal     = '';
                    @endphp
                    {{-- message image --}}
                    @include('users.messages.contents.parts.image')

                {{-- no data --}}
                @else

                @endif

                @if ($auth)
                    {{-- edit modal --}}
                    @include('users.messages.modal.edit')
                    {{-- delete modal --}}
                    @include('users.messages.modal.delete')
                @else
                    {{-- report modal --}}
                    @include('users.messages.modal.reportMsg')
                @endif

            @endforeach

            {{-- Larvel error messages from "send message" below --}}
            @error('text')
                <div class="text-danger small position-absolute bottom-0 end-0">
                    <span class="me-4 pb-3">{{ $message }}</span>
                </div>
            @enderror
            @error('image')
                <div class="text-danger small position-absolute bottom-0 end-0">
                    <span class="me-4 pb-3">{{ $message }}</span>
                </div>
            @enderror

            {{-- image preview from "send message" below --}}
            <figure id="figure" style="display: none" class="image-preview">
                <figcaption>Image Preview</figcaption>
                <img src="" alt="your image" id="figureImage" style="height: 100px">
            </figure>

        </div>
    </div>
</div>


{{-- send message --}}
<div class="bg-white p-2 mb-0 message-footer" id="footer">
    <form action="{{ route('messages.store', ['user' => $user]) }}" method="post" class="ms-0 ps-0" enctype="multipart/form-data" runat="server">
        @csrf
        <div class="row gx-2">
            <div class="col">
                <textarea name="text" id="text" rows="1" class="form-control form-control-sm col-sm" placeholder="Type your message">{{ old('text') }}</textarea>
            </div>
            <div class="col-auto mx-2">
                <label for="image" class="form-label col-sm-1"><i class="fa-solid fa-circle-plus fa-2x text-secondary"></i></label>
                <input accept="image/*" type="file" name="image" id="image" class="form-image">
            </div>
            <div class="col-auto">
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
