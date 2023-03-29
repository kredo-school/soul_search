@extends('layouts.app')

@section('title', 'Profile')

@section('styles')
    <link href="{{ mix('css/search.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h2 class="mt-3"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search</h2>
    <div>
        <input type="text" id="userInput" onkeyup="searchUserTag()" placeholder="input here" class="form-control">
        <ul id="searchUl" class="search_ul">
            @foreach ($users as $user)
                <li  style="display: none;">
                    <a href="{{ route('profiles.show', Auth::id()) }}" class="text-decoration-none">
                        <span>{{$user->username}}</span>
                    </a>
                </li>
            @endforeach
            @foreach ($tags as $tag)
                <li style="display: none;">
                    <a href="#" class="text-decoration-none">
                        <span>{{$tag->name}}</span>
                    </a>
                </li>
            @endforeach
        </ul>

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
