@extends('layouts.app')

@section('title'.'Tag Register')

@section('content')
<div class="container">
    <img src="{{ asset('images/logo.png')}}" class="float-left mt-2">
</div>

<div class="container"><h1 class="text-center fw-bold mb-3">Create Your Account</h1></div>

{{--  Card body  --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-8 mb-3 rounded-box btn-orange">
                            <span class="col-5 text-center text-orange rounded-box btn-white">Profile</span>
                            <span class="col-5 text-end text-white rounded-box">Tags</span>
                        </div>
                    </div>

                    <h2 class="text-center fw-bold mt-2">Your Profile</h2>
                    <p class="text-muted text-center mt-2">Enter the login information for your account.<br>You can edit it after registering.</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                    <div class="container">
                        <form action="">
                        {{--  Username  --}}
                        <div class="row mb-3 justify-content-center">
                            <div>
                                 <label for="name" class="text-position">{{ __('Username') }}</label>
                            </div>

                            <div class="col-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{--  Email  --}}
                        <div class="row mb-3 justify-content-center">
                            <div>
                                <label for="email" class="text-position">{{ __('Email') }}</label>
                            </div>

                            <div class="col-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{--  Password  --}}
                        <div class="row mb-3 justify-content-center">
                            <div>
                                <label for="password" class="text-position">{{ __('Password') }}</label>
                            </div>

                            <div class="col-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{--  Password confirmation  --}}
                        <div class="row mb-3 justify-content-center">
                            <div>
                                <label for="password-confirm" class="text-position">{{ __('Password Confirmation') }}</label>
                            </div>

                            <div class="col-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        {{--  Next button  --}}
                        <div class="row mb-0 justify-content-center">
                            <div class="d-grid gap-2 mt-3 col-6 ">
                                <button type="submit" class="btn btn-orange text-white mb-3">
                                    {{ __('Next') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>

                        {{--  Horizontal line  --}}
                        <div class="text-divider text-muted">or</div>

                        {{--  Facebook Logo  --}}
                        <div class="container justify-content-center logo-center">
                            <a class="" href="#">
                                <img class="icon-sm justify-content-center mt-3" src="{{asset('images/btn_facebook.svg')}}" alt="">
                            </a>
                        </div>
                        {{--  Message  --}}
                        <p class="mt-3 mb-4 text-center">Already have an account?
                            <a href="{{ route('login') }}" class="text-center text-orange text-decoration-none">Login here!</a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
