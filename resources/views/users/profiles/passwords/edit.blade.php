@extends('layouts.app')

@section('title', 'Edit Password')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row w-100">

            <div class="container">
                <h2 class="h5 mt-3">Edit Password</h2>

                <form action="{{ route('passwords.update', Auth::id()) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3 row">
                        <div class="col">
                            {{-- avatar --}}
                            @if ($user->avatar)
                                <img src="{{ asset('/storage/avatars/'. $user->avatar) }}" class="avatar-lg rounded-circle" alt="">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
                            @endif
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
                        <label for="tag" class="form-label">Tags(up to 3)</label>
                        @foreach ($tags as $tag)
                            <div class="col">
                                <input name="tag[]" type="text" class="form-control" id="tag[]" value="{{ old('tag[]', $tag->tag) }}" disabled>
                            </div>
                        @endforeach
                        @if ($tag_count < 3)
                            @for ($i = 0; $i < 3 - $tag_count; $i++)
                                <div class="col">
                                    <input name="tag[]" type="text" class="form-control" id="tag[]" value="{{ old('tag[]') }}" disabled>
                                </div>
                            @endfor
                        @endif
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

                    <div class="row mb-3">
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
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <div class="col">
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <div class="col">
                            <label for="introduction" class="form-label">Introduction</label>
                            <textarea name="introduction" class="form-control" id="introduction" cols="30" rows="2" disabled>{{ old('introduction', $user->introduction) }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-warning px-3">Update Password</button>
                    <a type="button" href="{{ route('profiles.edit', Auth::id()) }}" class="btn btn-sm btn-secondary px-3">Cancel</a>

                </form>

            </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

@endsection
