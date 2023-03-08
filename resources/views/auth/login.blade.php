@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <img src="{{ asset('img/logo.png')}}" class="float-left mt-2">
</div> -->
<div class="container"><h1 class="text-center fw-bold mb-3">  <img src="{{ asset('img/logo_modified.png')}}" class="float-left mt-2" width="450" height="120"></h1></div>

    <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0">
                <div class = "justify-content-center text-center">
                    <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="4.8"></g><g id="SVGRepo_iconCarrier"> <rect width="24" height="24" fill="white"></rect> <path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9999 6C9.79077 6 7.99991 7.79086 7.99991 10C7.99991 12.2091 9.79077 14 11.9999 14C14.209 14 15.9999 12.2091 15.9999 10C15.9999 7.79086 14.209 6 11.9999 6ZM17.1115 15.9974C17.8693 16.4854 17.8323 17.5491 17.1422 18.1288C15.7517 19.2966 13.9581 20 12.0001 20C10.0551 20 8.27215 19.3059 6.88556 18.1518C6.18931 17.5723 6.15242 16.5032 6.91351 16.012C7.15044 15.8591 7.40846 15.7251 7.68849 15.6097C8.81516 15.1452 10.2542 15 12 15C13.7546 15 15.2018 15.1359 16.3314 15.5954C16.6136 15.7102 16.8734 15.8441 17.1115 15.9974Z" fill="#ababab"></path> </g></svg>                    
                        <!-- <i class="fa-regular fa-circle-user text-center mt-3 icon-lg text-orange"></i> -->
                </div>
                    <h2 class="text-center fw-bold mt-3">{{ __('Login') }}</h2>
                            {{--  Message  --}}
                            <p class="text-center">Do not have an account?
                                <a href="{{ route('register') }}" class="text-center text-orange text-decoration-none">Sign up here!</a>
                            </p>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{--  Email  --}}
                            <div class="row mb-3">
                                <div>
                                    <label for="email" class="col-md-4 col-form-label">{{ __('Email Address') }}</label>
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
                                    <button type="submit" class="btn btn-orange text-white btn-block mb-2">
                                        {{ __('Login') }}
                                    </button>
                                </div>

                            </div>

                            {{--  Horizontal line  --}}
                            <div class="text-divider text-muted">or</div>

                            {{--  Facebook Logo  --}}
                            <!-- <div class="container justify-content-center logo-center">
                                <a class="" href="#">
                                    <img class="icon-sm justify-content-center mt-3 mb-4" src="{{asset('img/btn_facebook.svg')}}" alt="">
                                </a>
                                
                            </div> -->
                            <div class="d-grid gap-2 mt-3">
                                <a class="btn btn-primary btn-block mb-2 border-0" style="background-color: #1877F2;" href="#!" role="button"><i class="fab fa-facebook me-2"></i>Facebook</a>
                            </div>

                            
                            <div class="row justify-content-center">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                            <p class="text-center mt-3">{{ __('Forgot Your Password?') }}</p>
                                        </a>
                                    @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
