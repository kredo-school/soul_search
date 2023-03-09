@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container d-flex justify-content-center">
    <!-- Tags' bar -->
    <div class="col-2 bg-white tag-bar">
        <div class="mt-5">
            <p class="text-dark fw-bold mb-0 tag-name">Recent</p>
            <table class="table table-hover">
                {{-- @foreach ($recent_tags as $tag) --}}
                    <tr>
                        <td>
                            <a href="#">
                                <i class="fa-regular fa-hashtag"></i>
                            </a>
                        </td>
                        <td class="ps-0">
                            <a href="#" class="text-decoration-none text-dark tag-name">
                                Music
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">
                                <i class="fa-regular fa-hashtag"></i>
                            </a>
                        </td>
                        <td class="ps-0">
                            <a href="#" class="text-decoration-none text-dark tag-name">
                                Politics
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">
                                <i class="fa-regular fa-hashtag"></i>
                            </a>
                        </td>
                        <td class="ps-0">
                            <a href="#" class="text-decoration-none text-dark tag-name">
                                Food
                            </a>
                        </td>
                    </tr>
                {{-- @endforeach --}}
            </table>
        </div>
        <div class="mt-5">
            <p class="text-dark fw-bold mb-0 tag-name">Main</p>
            <table class="table table-hover">
                {{-- @foreach ($recent_tags as $tag) --}}
                    <tr>
                        <td>
                            <a href="#">
                                <i class="fa-regular fa-hashtag"></i>
                            </a>
                        </td>
                        <td class="ps-0">
                            <a href="#" class="text-decoration-none text-dark tag-name">
                                Movie
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">
                                <i class="fa-regular fa-hashtag"></i>
                            </a>
                        </td>
                        <td class="ps-0">
                            <a href="#" class="text-decoration-none text-dark tag-name">
                                Music
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">
                                <i class="fa-regular fa-hashtag"></i>
                            </a>
                        </td>
                        <td class="ps-0">
                            <a href="#" class="text-decoration-none text-dark tag-name">
                                Travel
                            </a>
                        </td>
                    </tr>
                {{-- @endforeach --}}
            </table>
        </div>
        <div class="my-5">
            <p class="text-dark fw-bold mb-0 tag-name">Fav</p>
            <table class="table table-hover">
                {{-- @foreach ($recent_tags as $tag) --}}
                    <tr>
                        <td>
                            <a href="#">
                                <i class="fa-regular fa-hashtag"></i>
                            </a>
                        </td>
                        <td class="ps-0">
                            <a href="#" class="text-decoration-none text-dark tag-name">
                                Book
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">
                                <i class="fa-regular fa-hashtag"></i>
                            </a>
                        </td>
                        <td class="ps-0">
                            <a href="#" class="text-decoration-none text-dark tag-name">
                                Health
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">
                                <i class="fa-regular fa-hashtag"></i>
                            </a>
                        </td>
                        <td class="ps-0">
                            <a href="#" class="text-decoration-none text-dark tag-name">
                                Technology
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">
                                <i class="fa-regular fa-hashtag"></i>
                            </a>
                        </td>
                        <td class="ps-0">
                            <a href="#" class="text-decoration-none text-dark tag-name">
                                Education
                            </a>
                        </td>
                    </tr>
                {{-- @endforeach --}}
            </table>
        </div>
    </div>
    <!-- Chats -->
    <div class="col">
        <!-- Header -->
        <div class="bg-white py-3 border border-top-0">
            <i class="fa-regular fa-hashtag fa-2x ps-5"></i>
            <a href="#" class="h2 ps-1 text-decoration-none fw-bold text-dark tag-header">Travel</a>
        </div>
        <!-- Body (Need to update to show chats the user wants) -->
        <div class="row mx-2 my-3 p-0">
            <div class="col-1">
                @include('contents.title')
            </div>
            <div class="col ps-0">
                @include('contents.body')
            </div>
        </div>
        <!-- Send bar -->
        <div class="bg-white">
            <form action="#" method="post">
                @csrf
                <div class="input-group">
                    <textarea name="chat" id="chat" rows="1" class="form-control form-control-sm" placeholder="Type your message #Travel">

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
@endsection
