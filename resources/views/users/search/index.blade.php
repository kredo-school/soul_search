@extends('layouts.app')

@section('title', 'Profile')

@section('styles')
    <link href="{{ mix('css/search.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="mt-2">
    <div class="row justify-content-center">
        <div class="col-md">
            <h2 class="mt-3"><i class="fa-solid fa-magnifying-glass me-3"></i>Search</h2>
            <div>
                <input type="text" id="userInput" onkeyup="searchUserTag()" placeholder="input here" class="form-control mt-3">
            </div>
            <ul id="searchUl" class="search_ul">
                @foreach ($users as $user)
                    <li class="mt-3 ms-2" style="display: none;">
                        <a href="{{ route('profiles.show', $user->id) }}" class="text-decoration-none">
                            <div class="row">
                                <div class="col-sm-auto">
                                    @if ($user->avatar)
                                        <img src="{{ asset('/storage/avatars/'. $user->avatar) }}" class="avatar-srch rounded-circle" alt="">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-srch"></i>
                                    @endif
                                </div>
                                <div class="col-sm">
                                    <div><span class="text-dark">{{$user->username}}</span></div>
                                    @php
                                        $follow_count = $user->follows->count();
                                    @endphp
                                    <div class="text-muted">
                                        @if ($follow_count > 1)
                                            {{$follow_count}}&nbsp;followers
                                        @else
                                            {{$follow_count}}&nbsp;follower
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
                @foreach ($tags as $tag)
                    <li class="mt-3 ms-2" style="display: none;">
                        {{-- need link to chat --}}
                        <a href="#" class="text-decoration-none">
                            <div class="row">
                                <div class="col-sm-auto">
                                    <i class="fa-solid fa-hashtag text-secondary icon-srch"></i>
                                </div>
                                <div class="col-sm">
                                    <div><span class="text-dark">{{$tag->name}}</span></div>
                                    <div class="text-muted">400 chats{{-- count chat numbers --}}</div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>
</div>


    <script>
        function searchUserTag() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('userInput');
            filter = input.value.toUpperCase();
            ul = document.getElementById("searchUl");
            li = ul.getElementsByTagName('li');

            // show items matching the search query
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("span")[0];
                txtValue = a.textContent || a.innerText;
                if (filter == ''){
                    li[i].style.display = "none";
                } else {
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }
        }
    </script>

@endsection
