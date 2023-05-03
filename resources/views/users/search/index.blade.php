@extends('layouts.app')

@section('title', 'Profile')

@section('styles')
    <link href="{{ mix('css/search.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="search-container mx-auto mt-0">

    <div class="search-header pt-3 pb-1">
        <h2 class="float-start"><i class="fa-solid fa-magnifying-glass me-3"></i>Search</h2>

        <button class="btn btn-sm btn-outline-secondary float-end ms-1 mb-1" id="dropdownMenuButtonSearch" data-bs-toggle="dropdown"><span id="resultDisp">Search: Users and Tags</span></button>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButtonSearch">
            <li>
                <a class="dropdown-item text-decoration-none" onclick="chngDisp1()" id="drpDwn1">Users</a>
            </li>
            <li>
                <a class="dropdown-item text-decoration-none" onclick="chngDisp2()" id="drpDwn2">Tags</a>
            </li>
        </ul>

        <div>
            <input type="text" id="userInput" onkeyup="searchUserTag()" placeholder="input here" class="form-control mt-3">
        </div>
    </div>

    <div class="row">
        <ul id="searchUl" class="search-ul">
            <span id="search-user">
                @foreach ($users as $user)
                    <li class="py-2 search-selected" style="display: none;">
                        <a href="{{ route('profiles.show', $user->id) }}" class="text-decoration-none">
                            <div class="row">
                                <div class="col-auto">
                                    @if ($user->avatar)
                                        <img src="{{ $user->avatar }}" class="avatar-srch rounded-circle" alt="">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-srch"></i>
                                    @endif
                                </div>
                                <div class="col">
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
            </span>
            <span id="search-tag">
                @foreach ($tags as $tag)
                    <li class="py-2 search-selected" style="display: none;">
                        <a href="{{ route('chats.show', $tag->id) }}" class="text-decoration-none">
                            <div class="row">
                                <div class="col-auto">
                                    <i class="fa-solid fa-hashtag text-secondary icon-srch"></i>
                                </div>
                                <div class="col">
                                    <div><span class="text-dark">{{$tag->name}}</span></div>
                                    @php
                                        $chat_count = $tag->chats->count();
                                    @endphp
                                    <div class="text-muted">
                                        @if ($chat_count > 1)
                                            {{$chat_count}}&nbsp;chats
                                        @else
                                            {{$chat_count}}&nbsp;chat
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </span>
        </ul>
    </div>

</div>

<script>
    // function to show only search result
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

    // function to show/hide searched users/tags
    var result = 'both';
    function chngDisp1() {
        if(result == 'both'){
            showUsers();
            resultDisp.innerHTML = 'Search: Users';
            result = 'users';
            drpDwn1.innerHTML = 'Users and Tags';
            drpDwn2.innerHTML = 'Tag';
        }else{
            showBoth();
            resultDisp.innerHTML = 'Search: Users and Tags';
            result = 'both';
            drpDwn1.innerHTML = 'Users';
            drpDwn2.innerHTML = 'Tags';
        }
    }
    function chngDisp2() {
        if(result == 'tags'){
            showUsers();
            resultDisp.innerHTML = 'Search: Users';
            result = 'users';
            drpDwn1.innerHTML = 'Users and Tags';
            drpDwn2.innerHTML = 'Tags';
        }else{
            showTags();
            resultDisp.innerHTML = 'Search: Tags';
            result = 'tags';
            drpDwn1.innerHTML = 'Users and Tags';
            drpDwn2.innerHTML = 'Users';
        }
    }

    function showBoth() {
        document.getElementById("search-user").style.display = '';
        document.getElementById("search-tag").style.display = '';
    }
    function showUsers() {
        document.getElementById("search-user").style.display = '';
        document.getElementById("search-tag").style.display = 'none';
    }
    function showTags() {
        document.getElementById("search-user").style.display = 'none';
        document.getElementById("search-tag").style.display = '';
    }

</script>

@endsection
