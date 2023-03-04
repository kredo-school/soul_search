@extends('layouts.app')

@section('title','Create Account')

@section('content')
<div class="container">
    <img src="{{ asset('img/logo.svg')}}" class="float-left mt-2">
</div>

<div class="container">
    <h1 class="text-center fw-bold mb-3">
        Create Your Account
    </h1>
</div>

{{--  Card body  --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-8 mb-3 rounded-box btn-orange ">
                            <span class="col-md-5 text-center text-white rounded-box">Profile</span>
                            <span class="col-md-5 box-right text-center text-orange rounded-box btn-white">Tags</span>
                        </div>
                    </div>

                    <h2 class="text-center fw-bold mt-2">Choose Tags</h2>
                    <p class="text-muted text-center mt-2">What kind of things are you interested in?</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{--  Tag1  --}}
                        <div class="row mb-3 justify-content-center">
                            <div>
                                 <label for="tag1" class="text-position">Tag1</label>
                            </div>

                            <div class="col-6">
                                <input id="tag1" type="text" class="form-control" name="tag1" value="" required autocomplete="tag1" autofocus>

                                {{--  @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  --}}
                            </div>
                        </div>

                        {{--  Tag2  --}}
                        <div class="row mb-3 justify-content-center">
                            <div>
                                 <label for="tag2" class="text-position">Tag2</label>
                            </div>

                            <div class="col-6">
                                <input id="tag2" type="text" class="form-control" name="tag2" value="" required autocomplete="tag2" autofocus>

                                {{--  @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  --}}
                            </div>
                        </div>

                        {{--  Tag3  --}}
                        <div class="row mb-3 justify-content-center">
                            <div>
                                 <label for="tag3" class="text-position">Tag3</label>
                            </div>

                            <div class="col-6">
                                <input id="tag3" type="text" class="form-control" name="tag3" value="" required autocomplete="tag3" autofocus>

                                {{--  @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  --}}
                            </div>
                        </div>

                        {{--  Create button  --}}
                        <div class="row mb-0 justify-content-center">
                            <div class="d-grid gap-2 mt-3 col-6 ">
                                <button type="submit" class="btn btn-orange text-white">
                                    {{ __('Create Account') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

                        {{--  Message  --}}
                        <p class="mt-1 mb-5 text-center">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-center text-orange text-decoration-none">
                                Login here!
                            </a>
                        </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
