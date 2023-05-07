@extends('layouts.app')

@section('styles')
    <link href="{{ mix('css/home.css') }}" rel="stylesheet">
@endsection

@section('title', 'Chat')

@section('content')
<div class="d-flex justify-content-center p-0">
    @if(Auth::user()->userTag()->exists())

        {{-- tag bar --}}
        @include('contents.tagbar')

        <!-- Chats -->
        <div class="col chat-view">
            <!-- Header -->
            <div class="bg-white py-2 border-bottom chat-header">
                <span class="d-none d-lg-inline">
                    <i class="fa-regular fa-hashtag hashtag-icon h3 ms-4"></i>
                    <a href="{{ route('chats.show', $tag->id) }}" class="h3 ps-1 text-decoration-none fw-bold tag-name">{{ $tag->name }}</a>
                </span>
                <span class="d-none d-sm-inline d-lg-none">
                    <i class="fa-regular fa-hashtag hashtag-icon h4 ms-4"></i>
                    <a href="{{ route('chats.show', $tag->id) }}" class="h4 ps-1 text-decoration-none fw-bold tag-name">{{ $tag->name }}</a>
                </span>
                <span class="d-inline d-sm-none">
                    <i class="fa-regular fa-hashtag hashtag-icon h5 ms-4"></i><a href="{{ route('chats.show', $tag->id) }}" class="h5 ps-1 text-decoration-none fw-bold tag-name">{{ $tag->name }}</a>
                </span>
            </div>

            <!-- Body -->
            <div class="row pt-0 chat-body" id="chbody">
                <div class="chat-element">
                    @include('contents.body')
                </div>
            </div>

            <!-- Form -->
            <div class="pt-2 pb-0 align-bottom chat-form">
                <form action="{{ route('chats.store', $tag->id) }}" method="post" class="ms-2 ps-0 pt-1" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-2">
                        <div class="col">
                            <textarea name="chat" id="chat" rows="1" class="form-control form-control-sm col-sm auto-adjust" placeholder="Type your message #{{ $tag->name }}"></textarea>
                            <span class="chat-error">
                                @error('chat')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                                @error('image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </span>
                        </div>
                        <div class="col-auto">
                            <label for="image" title="add image" class="form-label col-sm-1"><i class="fa-solid fa-circle-plus fa-2x text-secondary mx-1"></i></label>
                            <input type="file" name="image" id="image" accept="image/*" class="form-image">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-orange btn-sm btn-send me-2">Send</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        {{-- image preview from "send message" below --}}
        <figure id="figure" style="display: none" class="image-preview">
            <figcaption>Image Preview</figcaption>
            <img src="" alt="your image" id="figureImage" style="height: 100px">
        </figure>
    @else
        <div class="text-center">
            <p class="text-muted" style="transform: translateY(40vh)">You don't have any tags yet.</p>
        </div>
    @endif
</div>

<script>
    // resize textarea based on lines
    let ch = document.documentElement.clientHeight // window height
    let h = 28 // form height
    document.getElementById('chbody').style.height = ch-103+"px"
    document.querySelectorAll(".auto-adjust").forEach(function(){
        this.addEventListener('keydown',function(e){
            e.srcElement.style.height = e.srcElement.scrollHeight+"px"

            h = e.srcElement.scrollHeight // form height
            document.getElementById('chbody').style.height = ch-h-75+"px"
        })
    })
    window.addEventListener('resize', function(){
        ch = document.documentElement.clientHeight
        document.getElementById('chbody').style.height = ch-h-75+"px"
    })

    // image preview
    function main () {
        const input = document.querySelector('#image')
        const figure = document.querySelector('#figure')
        const figureImage = document.querySelector('#figureImage')

        input.addEventListener('change', (event) => {
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

@endsection
