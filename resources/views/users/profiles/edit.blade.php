@extends('layouts.app')

@section('title', 'Edit Profile')

@section('styles')
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="profile-container mx-auto">
    <div class="row justify-content-center">
        <div class="col-md">

            <h2 class="h5 mt-3">Edit Profile</h2>

            <form action="{{ route('profiles.update', Auth::id()) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="mb-3 row">
                    {{-- avatar --}}
                    <div class="col">
                        <div class="dropdown">
                            <button class="btn shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if ($user->avatar)
                                    <img src="{{ asset('/storage/avatars/'. $user->avatar) }}" class="avatar-lg rounded-circle" alt="">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
                                @endif
                            </button>
                            <ul class="dropdown-menu">
                                <li class="ps-3">
                                    <a href="{{ route('avatars.edit', Auth::id()) }}" class="text-decoration-none text-orange">
                                        <i class="fa-solid fa-pencil"></i> Edit Image
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{-- username --}}
                    <div class="col">
                        <label for="username" class="form-label">Username</label>
                        <input tyoe="text" name="username" class="form-control" id="username" value="{{ old('username', $user->username) }}" required autofocus>
                        @error('username')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- email --}}
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input tyoe="text" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- tags --}}
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
                <div class="mb-1 row">
                    <div class="col-10">
                        @foreach ($main_tags as $main_tag)
                            <span class="btn btn-sm btn-secondary float-start me-1 mb-1">#{{ $main_tag->tag->name }}</span>
                        @endforeach
                    </div>
                    <div class="col">
                        <a href="{{ route('tags.edit', $user->id) }}" class="btn btn-orange mb-1 me-1 float-end">edit tags</a>
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

                {{-- password --}}
                <div class="row">
                    <div class="col">
                        <label for="current_password" class="form-label">Current Password</label>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="current_password" class="form-control" id="current_password" value="••••••••" disabled>
                    </div>
                    <div class="col">
                        <a href="{{ route('passwords.edit', Auth::id()) }}" type="button" class="btn btn-orange px-3">Change Password</a>
                    </div>
                    <div class="col"></div>
                </div>

                {{-- introduction --}}
                <div class="mb-4 row">
                    <div class="col">
                        <label for="introduction" class="form-label">Introduction</label>
                        <textarea name="introduction" class="form-control" id="introduction" cols="30" rows="4">{{ old('introduction', $user->introduction) }}</textarea>
                        @error('introduction')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <a type="button" href="{{ route('profiles.index') }}" class="btn btn-secondary px-3 float-end">Cancel</a>
                <button type="submit" class="btn btn-orange px-3 float-end me-3">Update</button>

            </form>
        </div>
    </div>
</div>


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
