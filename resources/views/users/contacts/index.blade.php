@extends('layouts.app')

@section('title', 'ContactUs')

@section('styles')
    <link href="{{ mix('css/contact.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="mt-5 contact_container mx-auto">
        <div class="card border-0">
            <h1 class="text-center mt-5">Contact Us</h1>

            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <p class="text-muted text-sm mb-3">Don't hesitate to contact us if you have any questions.<br>We'd love to hear from you. We'll respond as soon as possible.</p>
                    </div>
                </div>

                <form action="{{ route('contact.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-3 row justify-content-center">
                        <div class="col-10">
                            <label for="message" class="form-label mt-3">message</label>
                            <textarea name="message" class="form-control" id="message" cols="30" rows="4" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="my-5 text-center">
                        <button type="submit" class="btn btn-orange px-4">
                            Send Message
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
