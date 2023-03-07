@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <!-- Navbar -->
    <div class="col-2 h-100 bg-white">
        @include('layouts.side')
    </div>

    <!-- Tags' bar -->
    <div class="col-2 h-100 bg-white">
        <div class="mt-3">
            <div class="row">
                <p class="text-dark fw-bold tag-bar">Recent</p>
                <table class="table table-hover align-middle">
                    {{-- @foreach ($recent_tags as $tag) --}}
                        <tr>
                            <td class="col-auto">
                                <a href="#">
                                    <i class="fa-regular fa-hashtag"></i>
                                </a>
                            </td>
                            <td class="col ps-0">
                                <a href="#" class="text-decoration-none text-dark tag-bar">
                                    Music
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-auto">
                                <a href="#">
                                    <i class="fa-regular fa-hashtag"></i>
                                </a>
                            </td>
                            <td class="col ps-0">
                                <a href="#" class="text-decoration-none text-dark tag-bar">
                                    Politics
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-auto">
                                <a href="#">
                                    <i class="fa-regular fa-hashtag"></i>
                                </a>
                            </td>
                            <td class="col ps-0">
                                <a href="#" class="text-decoration-none text-dark tag-bar">
                                    Food
                                </a>
                            </td>
                        </tr>
                    {{-- @endforeach --}}
                </table>
            </div>
        </div>
        <div class="mt-3">
            <div class="row">
                <p class="text-dark fw-bold tag-bar">Main</p>
                <table class="table table-hover align-middle">
                    {{-- @foreach ($recent_tags as $tag) --}}
                        <tr>
                            <td class="col-auto">
                                <a href="#">
                                    <i class="fa-regular fa-hashtag"></i>
                                </a>
                            </td>
                            <td class="col ps-0">
                                <a href="#" class="text-decoration-none text-dark tag-bar">
                                    Movie
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-auto">
                                <a href="#">
                                    <i class="fa-regular fa-hashtag"></i>
                                </a>
                            </td>
                            <td class="col ps-0">
                                <a href="#" class="text-decoration-none text-dark tag-bar">
                                    Music
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-auto">
                                <a href="#">
                                    <i class="fa-regular fa-hashtag"></i>
                                </a>
                            </td>
                            <td class="col ps-0">
                                <a href="#" class="text-decoration-none text-dark tag-bar">
                                    Travel
                                </a>
                            </td>
                        </tr>
                    {{-- @endforeach --}}
                </table>
            </div>
        </div>
        <div class="mt-3">
            <div class="row">
                <p class="text-dark fw-bold tag-bar">Fav</p>
                <table class="table table-hover align-middle">
                    {{-- @foreach ($recent_tags as $tag) --}}
                        <tr>
                            <td class="col-auto">
                                <a href="#">
                                    <i class="fa-regular fa-hashtag"></i>
                                </a>
                            </td>
                            <td class="col ps-0">
                                <a href="#" class="text-decoration-none text-dark tag-bar">
                                    Book
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-auto">
                                <a href="#">
                                    <i class="fa-regular fa-hashtag"></i>
                                </a>
                            </td>
                            <td class="col ps-0">
                                <a href="#" class="text-decoration-none text-dark tag-bar">
                                    Health
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-auto">
                                <a href="#">
                                    <i class="fa-regular fa-hashtag"></i>
                                </a>
                            </td>
                            <td class="col ps-0">
                                <a href="#" class="text-decoration-none text-dark tag-bar">
                                    Technology
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-auto">
                                <a href="#">
                                    <i class="fa-regular fa-hashtag"></i>
                                </a>
                            </td>
                            <td class="col ps-0">
                                <a href="#" class="text-decoration-none text-dark tag-bar">
                                    Education
                                </a>
                            </td>
                        </tr>
                    {{-- @endforeach --}}
                </table>
            </div>
        </div>
        <!-- Chats -->
        <div class="col-auto">
            <div class="row">
                <!-- Header -->
                <div class="w-100">
                    <i class="fa-regular fa-hashtag"></i>
                    <a href="#" class="text-decoration-none text-dark tag-header">{{ $tag->tag }}</a>
                </div>
                <!-- Body (Need to update to show chats the user wants) -->
                <div class="ms-3">
                    <div class="col-2">
                        @include('contents.title')
                    </div>
                    <div class="col">
                        @include('contents.body')
                    </div>
                </div>
                <!-- Send bar -->
                <form action="{{ route('chat.store') }}" method="post" class="">
                    @csrf
                    <div class="input-group">
                        <textarea name="chat" id="chat" rows="3" class="form-control" placeholder="Type your message #{{ $tag->tag }}">
                            {{ old('chat') }}
                        </textarea>
                        <button type="submit" class="btn btn-orange">Send</button>
                    </div>
                    @error('chat')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
