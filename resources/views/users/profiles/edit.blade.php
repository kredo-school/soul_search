@extends('layouts.app')

@section('title', 'Edit Profile')

@section('styles')
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row w-100">

            <div class="container">
                <h2 class="h5 mt-3">Edit Profile</h2>

                <form action="{{ route('profile.update', Auth::id()) }}" method="post">
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
                                        <a href="{{ route('avatar.edit', Auth::id()) }}" class="text-decoration-none text-orange">
                                            <i class="fa-solid fa-pencil"></i> Edit Image
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col">
                            <label for="name" class="form-label">Username</label>
                            <input tyoe="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
                            @error('name')
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
                        <label for="tag" class="form-label">Tags(up to 3)</label>
                        @foreach ($tags as $tag)
                            <div class="col">
                                <input name="tag[]" type="text" class="form-control" id="tag[]" value="{{ old('tag[]', $tag->tag) }}">
                                <input name="old_tag_id[]" type="hidden" value="{{ $tag->id }}">
                            </div>
                        @endforeach
                        @if ($tag_count < 3)
                            @for ($i = 0; $i < 3 - $tag_count; $i++)
                                <div class="col">
                                    <input name="tag[]" type="text" class="form-control" id="tag[]" value="{{ old('tag[]') }}">
                                </div>
                            @endfor
                        @endif
                        <input name="old_tag_count" type="hidden" value="{{ $tag_count }}">
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="current-password" class="form-label">Current Password</label>
                            <input tyoe="text" name="current_password" class="form-control" id="current-password" value="{{ old('password', $user->password) }}">
                            @error('current_password')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col">
                            <button type="button" class="btn btn-sm btn-orange px-3">Change Password</button>

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
                    <a type="button" href="{{ route('profile.index') }}" class="btn btn-sm btn-secondary px-3">Cancel</a>

                </form>

            </div>

    </div>

@endsection
