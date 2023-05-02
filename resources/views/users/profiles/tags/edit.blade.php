@extends('layouts.app')

@section('title', 'Edit Profile')

@section('styles')
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="profile-container mx-auto">
    <div class="row justify-content-center">
        <div class="col-md">

            <h2 class="h5 mt-3">Edit Tags</h2>

            <div class="mb-3 row">
                <div class="col">
                    <div class="dropdown">
                        <button class="btn shadow-none" type="button">
                            @if ($user->avatar)
                                <img src="{{ $user->avatar }}" class="avatar-lg rounded-circle" alt="">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
                            @endif
                        </button>
                    </div>
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
                <div class="col-10">
                    @foreach ($main_tags as $main_tag)
                        <span class="btn btn-sm btn-secondary float-start me-1 mb-1">#{{ $main_tag->tag->name }}</span>
                    @endforeach
                </div>
                <div class="col">
                    @if ($main_count > 1)
                        <a href="" class="btn btn-sm btn-outline-danger mb-1 float-end" data-bs-toggle="modal" data-bs-target="#removeMainModal">remove</a>
                    @endif
                    @if($main_count < 3)
                        <a href="" class="btn btn-sm btn-orange mb-1 me-1 float-end" data-bs-toggle="modal" data-bs-target="#addMainModal">add</a>
                    @endif
                </div>
                @include('users.profiles.tags.modal.main.remove')
                @include('users.profiles.tags.modal.main.add')

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
                <div class="col-10">
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
                <div class="col">
                    @if ($fav_count > 0)
                        <a href="" class="btn btn-sm btn-outline-danger mb-1 float-end" data-bs-toggle="modal" data-bs-target="#removeFavModal">remove</a>
                    @endif
                    <a href="" class="btn btn-sm btn-orange mb-1 me-1 float-end" data-bs-toggle="modal" data-bs-target="#addFavModal">add</a>
                </div>
                @include('users.profiles.tags.modal.fav.remove')
                @include('users.profiles.tags.modal.fav.add')
            </div>
            <div class="row">
                <div class="col">
                    {{-- error message for add tag --}}
                    @error('name')
                        <p class="text-danger small float-end">tag can only include number and characters</p>
                    @enderror
                </div>
            </div>


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
                <div class="col"></div>
                <div class="col"></div>
            </div>

            <div class="mb-4 row">
                <div class="col">
                    <label for="introduction" class="form-label">Introduction</label>
                    <textarea name="introduction" class="form-control" id="introduction" cols="30" rows="4" disabled></textarea>
                </div>
            </div>
            <a type="button" href="{{ route('profiles.edit', $user->id) }}" class="btn btn-secondary px-3 float-end">Cancel</a>

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
