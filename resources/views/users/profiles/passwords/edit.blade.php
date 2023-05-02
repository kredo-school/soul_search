@extends('layouts.app')

@section('title', 'Edit Password')

@section('styles')
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="profile-container mx-auto">
    <div class="row justify-content-center">
        <div class="col-md">

            <h2 class="h5 mt-3">Edit Password</h2>

            <form action="{{ route('passwords.update', Auth::id()) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="mb-3 row">
                    <div class="col">
                        <button class="btn shadow-none" type="button">
                            {{-- avatar --}}
                            @if ($user->avatar)
                                <img src="{{ $user->avatar }}" class="avatar-lg rounded-circle" alt="">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
                            @endif
                        </button>
                    </div>
                    <div class="col">
                        <label for="username" class="form-label">Username</label>
                        <input tyoe="text" name="username" class="form-control" id="username" value="{{ old('username', $user->username) }}" disabled>
                    </div>
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input tyoe="text" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        @php
                            $main_count = count($main_tags);
                            if($main_count == 1){
                                $main_s = '';
                            }else{
                                $main_s = 's';
                            }
                        @endphp
                        <label class="form-label">Your Main Tag{{$main_s}}</label>
                    </div>
                </div>
                <div class="mb-2 row">
                    <div class="col">
                        @foreach ($main_tags as $main_tag)
                            <span class="btn btn-sm btn-secondary float-start me-1 mb-1">#{{ $main_tag->tag->name }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        @php
                            $fav_count = count($fav_tags);
                            if($fav_count == 1){
                                $fav_s = '';
                            }else{
                                $fav_s = 's';
                            }
                        @endphp
                        <label class="form-label">Your Favorite Tag{{$fav_s}}</label>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        {{-- show 10 tags at most, push button to show more --}}
                        @if($fav_count <= 10)
                            @foreach ($fav_tags as $fav_tag)
                                <span class="btn btn-sm btn-secondary float-start me-1 mb-1">#{{ $fav_tag->tag->name }}</span>
                            @endforeach
                        @else
                            @for ($i=0; $i<10; $i++)
                                <span class="btn btn-sm btn-secondary float-start me-1 mb-1">#{{ $fav_tags[$i]->tag->name }}</span>
                            @endfor
                            <span class="btn btn-sm btn-outline-secondary float-start mb-1" id="favshow" onclick="showFav()">show more</span>
                            {{-- show after pushing button if more than 10 tags--}}
                            <span id="favtags">
                                @if ($fav_count <=25)
                                    @for ($i=10; $i<$fav_count; $i++)
                                        <span class="btn btn-sm btn-secondary float-start me-1 mb-1">#{{ $fav_tags[$i]->tag->name }}</span>
                                    @endfor
                                    <span class="btn btn-sm btn-outline-secondary float-start mb-1" onclick="hideFav()">hide</span>
                                @else
                                    @for ($i=10; $i<25; $i++)
                                        <span class="btn btn-sm btn-secondary float-start me-1 mb-1">#{{ $fav_tags[$i]->tag->name }}</span>
                                    @endfor
                                    <span class="btn btn-sm btn-outline-secondary float-start mb-1" id="favshow2" onclick="showFav2()">show more</span>
                                    <span id="favtags2">
                                        @for ($i=25; $i<$fav_count; $i++)
                                            <span class="btn btn-sm btn-secondary float-start me-1 mb-1">#{{ $fav_tags[$i]->tag->name }}</span>
                                        @endfor
                                        <span class="btn btn-sm btn-outline-secondary float-start mb-1" onclick="hideFav2()">hide</span>
                                    </span>
                                @endif
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="current_password" class="form-label">Current Password</label>
                    </div>
                    <div class="col">
                        <label for="new_password" class="form-label">New Password</label>
                    </div>
                    <div class="col">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <input type="password" name="current_password" class="form-control" required>
                        @if($errors->any())
                        {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                        @endif
                        @if(Session::get('error') && Session::get('error') != null)
                        <div style="color:red">{{ Session::get('error') }}</div>
                        @php
                        Session::put('error', null)
                        @endphp
                        @endif
                    </div>
                    <div class="col">
                        <input type="password" name="new_password" class="form-control" required autofocus>
                    </div>
                    <div class="col">
                        <input type="password" name="new_password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <a type="button" href="{{ route('profiles.edit', Auth::id()) }}" class="btn btn-secondary px-3 float-end">Cancel</a>
                    <button type="submit" class="btn btn-warning px-3 float-end me-3">Update Password</button>

                </div>

                <div class="row">
                    <div class="col">
                        <label for="introduction" class="form-label">Introduction</label>
                        <textarea name="introduction" class="form-control" id="introduction" cols="30" rows="4" disabled></textarea>
                    </div>
                </div>


            </form>
        </div>
    </div>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script>
        document.getElementById("favtags").style.display = 'none';
        function showFav(){
            document.getElementById("favshow").style.display = 'none';
            document.getElementById("favtags").style.display = 'inline';
        }
        function hideFav(){
            document.getElementById("favshow").style.display = 'inline-block';
            document.getElementById("favtags").style.display = 'none';
        }
        function showFav2(){
            document.getElementById("favshow2").style.display = 'none';
            document.getElementById("favtags2").style.display = 'inline';
        }
        function hideFav2(){
            document.getElementById("favshow2").style.display = 'inline-block';
            document.getElementById("favtags2").style.display = 'none';
        }
    </script>

@endsection
