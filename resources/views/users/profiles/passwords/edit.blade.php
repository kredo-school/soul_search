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
                                <img src="{{ asset('/storage/avatars/'. $user->avatar) }}" class="avatar-lg rounded-circle" alt="">
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

                <div class="mb-3 row">
                    <label for="m_tag_str" class="form-label">Your Main Tags (at least 1)</label>
                    @php
                        $m_tag_str       = '';
                    @endphp
                    @foreach ($main_tags as $main_tag)
                        @php
                            $m_tag_str .= '#' . $main_tag->tag->name . ' ';
                        @endphp
                    @endforeach
                    <div class="col">
                        <input name="m_tag_str" type="text" class="form-control" id="m_tag_str" value="{{ old('m_tag_str', $m_tag_str) }}" disabled>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="fav_tag_string" class="form-label">Your Favorite Tags</label>
                    @php
                        $f_tag_str       = '';
                    @endphp
                    @foreach ($fav_tags as $fav_tag)
                        @php
                            $f_tag_str .= '#' . $fav_tag->tag->name . ' ';
                        @endphp
                    @endforeach
                    <div class="col">
                        <textarea name="f_tag_str" class="form-control" id="f_tag_str" cols="30" rows="2" disabled>{{ old('f_tag_str', $f_tag_str) }}</textarea>
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
                        <textarea name="introduction" class="form-control" id="introduction" cols="30" rows="2" disabled>{{ old('introduction', $user->introduction) }}</textarea>
                    </div>
                </div>


            </form>
        </div>
    </div>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

@endsection
