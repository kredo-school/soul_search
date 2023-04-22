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
                        <input tyoe="text" name="username" class="form-control" id="username" value="{{ old('username', $user->username) }}" required>
                        @error('username')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input tyoe="text" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="m_tag_str" class="form-label">Your Main Tags (at least 1)</label>
                    @php
                        $m_tag_str       = '';
                        $old_m_tag_count = 0;
                    @endphp
                    @foreach ($main_tags as $main_tag)
                        @php
                            $m_tag_str .= '#' . $main_tag->tag->name . ' ';
                            $old_m_tag_count++;
                        @endphp
                        <input name="old_m_tag_ids[]" type="hidden" value="{{ $main_tag->tag->id }}">
                    @endforeach
                    <input name="old_m_tag_count" type="hidden" value="{{ $old_m_tag_count }}">
                    <div class="col">
                        <input name="m_tag_str" type="text" class="form-control" id="m_tag_str" value="{{ old('m_tag_str', $m_tag_str) }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="fav_tag_string" class="form-label">Your Favorite Tags</label>
                    @php
                        $f_tag_str       = '';
                        $old_f_tag_count = 0;
                    @endphp
                    @foreach ($fav_tags as $fav_tag)
                        @php
                            $f_tag_str .= '#' . $fav_tag->tag->name . ' ';
                            $old_f_tag_count++;
                        @endphp
                        <input name="old_f_tag_ids[]" type="hidden" value="{{ $fav_tag->tag->id }}">
                    @endforeach
                    <div class="col">
                        <textarea name="f_tag_str" class="form-control" id="f_tag_str" cols="30" rows="2">{{ old('f_tag_str', $f_tag_str) }}</textarea>
                        <input name="old_f_tag_count" type="hidden" value="{{ $old_f_tag_count }}">
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
</div>

@endsection
