@extends('layouts.app')

@section('title', 'Edit Image')

@section('styles')
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>
@endsection

@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col">
            {{-- avatar --}}
            <form action="/upload" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image">
                <div id="crop-area"></div>
                <input type="hidden" name="x" id="x">
                <input type="hidden" name="y" id="y">
                <input type="hidden" name="width" id="width">
                <input type="hidden" name="height" id="height">
                <button type="submit">Upload</button>
            </form>
        </div>
    </div>
</div>

{{-- javascript to crop avatar image --}}
<script>
    var cropper = new Cropper(document.getElementById('crop-area'), {
        aspectRatio: 1,
        crop: function(event) {
            document.getElementById('x').value = event.detail.x;
            document.getElementById('y').value = event.detail.y;
            document.getElementById('width').value = event.detail.width;
            document.getElementById('height').value = event.detail.height;
        }
    });
</script>

@endsection
