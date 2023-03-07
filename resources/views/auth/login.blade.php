@extends('layouts.app')

@section('content')
<div class="container">
    <img src="{{ asset('img/logo.png')}}" class="float-left mt-2">
</div>
    <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card"><i class="fa-regular fa-circle-user text-center mt-3 icon-lg text-orange"></i>
                    <h1 class="text-center mt-3">{{ __('Login') }}</h1>


                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{--  Email  --}}
                            <div class="row mb-3">
                                <div>
                                    <label for="email" class="col-md-4 col-form-label ">{{ __('Email Address') }}</label>
                                </div>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--  Password  --}}
                            <div class="row mb-3">
                                <div>
                                    <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                                </div>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--  Login button  --}}
                            <div class="row mb-0">
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-orange text-white">
                                        {{ __('Login') }}
                                    </button>
                                </div>

                                <div class="row justify-content-center">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            <p class="text-center mt-3">{{ __('Forgot Your Password?') }}</p>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            {{--  Horizontal line  --}}
                            <div class="text-divider text-muted">or</div>

                            {{--  Facebook Logo  --}}
                            <div class="container justify-content-center logo-center">
                                <a class="" href="#">
                                    <img class="icon-sm justify-content-center mt-3" src="{{asset('img/btn_facebook.svg')}}" alt="">
                                </a>
                            </div>
                            {{--  Message  --}}
                            <p class="mt-3 mb-4 text-center">Do not have an account?
                                <a href="{{ route('register') }}" class="text-center text-orange text-decoration-none">Sing up here!</a>
                            </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
