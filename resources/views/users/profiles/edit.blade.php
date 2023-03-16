@extends('layouts.app')

@section('title', 'Edit Profile')

@section('style')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row w-100">

            <div class="container">
                <h2 class="h5 mt-3">Edit Profile</h2>

                {{-- avatar --}}
                @if ($user->avatar)
                    <img src="{{ asset('/storage/images/'. $user->avatar) }}" class="" alt="">
                @else
                    <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
                @endif

                <form action="{{ route('profile.update', Auth::id()) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input tyoe="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <p class="text-danger small">{{ $name }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input tyoe="text" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <p class="text-danger small">{{ $email }}</p>
                        @enderror
                    </div>



                    <div class="mb-3">
                        <label for="tag" class="form-label">Tags(up to 3)</label>
                        @foreach ($tags as $tag)
                            <input name="tag[]" type="text" class="form-control" id="tag[]" value="{{ old('tag[]', $tag->tag) }}">
                            <input name="old_tag_id[]" type="hidden" value="{{ $tag->id }}">
                        @endforeach
                        @if ($tag_count < 3)
                            @for ($i = 0; $i < 3 - $tag_count; $i++)
                                <input name="tag[]" type="text" class="form-control" id="tag[]" value="{{ old('tag[]') }}">
                            @endfor
                        @endif
                        <input name="old_tag_count" type="hidden" value="{{ $tag_count }}">
                    </div>

                    <div class="mb-3">
                        <label for="introduction" class="form-label">Introduction</label>
                        <textarea name="introduction" class="form-control" id="introduction" cols="30" rows="2">{{ old('introduction', $user->introduction) }}</textarea>
                        @error('introduction')
                            <p class="text-danger small">{{ $introduction }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-sm btn-warning px-3">Update</button>
                    <a type="button" href="{{ route('profile.index') }}" class="btn btn-sm btn-secondary px-3">Cancel</a>

                </form>

            </div>

    </div>

@endsection
