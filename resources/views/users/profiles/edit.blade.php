@extends('layouts.app')

@section('title', 'Edit Profile')

@section('styles')
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row w-100">

            <div class="container">
                <h2 class="h5 mt-3">Edit Profile</h2>

                <form action="{{ route('profiles.update', Auth::id()) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3 row">
                        <div class="col">
                            <div class="dropdown">
                                <button class="btn shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{-- avatar --}}
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
                        <div class="col">
                            <label for="username" class="form-label">Username</label>
                            <input tyoe="text" name="username" class="form-control" id="username" value="{{ old('username', $user->username) }}">
                            @error('username')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input tyoe="text" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tag_name" class="form-label">Tags(up to 3)</label>
                        @foreach ($tags as $tag)
                            <div class="col">
                                <input name="tag_name[]" type="text" class="form-control" id="tag_name[]" value="{{ old('tag_name[]', $tag->name) }}">
                                <input name="old_tag_id[]" type="hidden" value="{{ $tag->id }}">
                            </div>
                        @endforeach
                        @if ($tag_count < 3)
                            @for ($i = 0; $i < 3 - $tag_count; $i++)
                                <div class="col">
                                    <input name="tag_name[]" type="text" class="form-control" id="tag_name[]" value="{{ old('tag_name[]') }}">
                                </div>
                            @endfor
                        @endif
                        <input name="old_tag_count" type="hidden" value="{{ $tag_count }}">
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
                        <div class="col">
                            <a href="{{ route('passwords.edit', Auth::id()) }}" type="button" class="btn btn-warning px-3">Change Password</a>
                        </div>
                        <div class="col"></div>
                    </div>

                    <div class="mb-4 row">
                        <div class="col">
                            <label for="introduction" class="form-label">Introduction</label>
                            <textarea name="introduction" class="form-control" id="introduction" cols="30" rows="2">{{ old('introduction', $user->introduction) }}</textarea>
                            @error('introduction')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-warning px-3">Update</button>
                    <a type="button" href="{{ route('profiles.index') }}" class="btn btn-sm btn-secondary px-3">Cancel</a>

                </form>

            </div>

    </div>

@endsection
