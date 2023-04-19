@extends('layouts.app')

@section('title', 'Edit Image')

@section('styles')
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col">
            {{-- avatar --}}
            @if ($user->avatar)
                <img src="{{ asset('/storage/avatars/'. $user->avatar) }}" class="avatar-ex-lg rounded-circle" alt="">
            @else
                <i class="fa-solid fa-circle-user text-secondary icon-ex-lg"></i>
            @endif
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <form action="{{ route('avatars.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <input type="file" class="form-control" id="avatar" name="avatar" aria-describedby="image-info" accept="image/*" required>
                    <div class="text-muted text-sm">Acceptable formats: jpeg, jpg, png, gif</div>
                    <div class="text-muted text-sm">Max file size is 1048kb</div>
                    @error('avatar')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-sm btn-warning px-3">Update Image</button>
                <a type="button" href="{{ route('profiles.edit', $user->id) }}" class="btn btn-sm btn-secondary px-3">Cancel</a>

            </form>

        </div>

    </div>

</div>


@endsection
