@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <img src="{{ asset('img/logo.png')}}" class="float-left mt-2">
</div> -->

<!-- <div class="container"><h1 class="text-center fw-bold mb-3">Create Your Account</h1></div> -->
<div class="container"><h1 class="text-center fw-bold mb-3">  <img src="{{ asset('img/logo_modified.png')}}" class="float-left mt-2" width="450" height="120"></h1></div>

{{--  Card body  --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mb-4 border-0">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                            <button class="btn btn-orange form-control text-white btn-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-1-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002H7.971L6.072 5.385v1.271l1.834-1.318h.065V12h1.312V4.002Z"/>
                                    </svg>
                                    Profile
                                </button>
                            </div>
                            <div class="col">
                                <button class="btn btn-orange form-control text-white btn-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-2-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM6.646 6.24c0-.691.493-1.306 1.336-1.306.756 0 1.313.492 1.313 1.236 0 .697-.469 1.23-.902 1.705l-2.971 3.293V12h5.344v-1.107H7.268v-.077l1.974-2.22.096-.107c.688-.763 1.287-1.428 1.287-2.43 0-1.266-1.031-2.215-2.613-2.215-1.758 0-2.637 1.19-2.637 2.402v.065h1.271v-.07Z"/>
                                    </svg>
                                    Tags
                                </button>
                            </div>
                        </div>
                    </div>                            
                            <!-- <span class="text-white">Profile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <span class="text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tags</span> -->

                            <!-- <span class="text-white">Profile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <span class="text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tags</span> -->

                    <h2 class="text-center fw-bold mt-3">{{ __('Create Your Account') }}</h2>
                    <p class="text-muted text-center">Enter the login information for your account.<br>You can edit it after registering.</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <!-- {{--  Username  --}}
                        <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        {{--  Username  --}}
                            <div class="row mb-3 ">
                                <div>
                                    <label for="name" class="col-md-2 col-form-label">{{ __('Username') }}</label>
                                </div>

                                <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        <!-- {{--  Email  --}}
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->
                        {{--  Email  --}}
                            <div class="row mb-3">
                                <div>
                                    <label for="email" class="col-md-2 col-form-label">{{ __('Email') }}</label>
                                </div>

                                <div class="col-md-12">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
<!-- 
                        {{--  Password  --}}
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        {{--  Password  --}}
                            <div class="row mb-3">
                                <div>
                                    <label for="password" class="col-md-2 col-form-label">{{ __('Password') }}</label>
                                </div>

                                <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

<!-- 
                        {{--  Password confirmation  --}}
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Password Confirmation') }}</label>

                            <div class="col-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> -->

                        {{--  Password Confirm --}}
                            <div class="row mb-2">
                                <div>
                                    <label for="password" class="col-md-6 col-form-label">{{ __('Password Confirmation') }}</label>
                                </div>

                                <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                         
                                </div>
                            </div>


                        <!-- {{--  Next button  --}}
                        <div class="row mb-0 justify-content-center">
                            <div class="d-grid gap-2 mt-3 col-6 ">
                                <button type="submit" class="btn btn-orange text-white mb-3">
                                    {{ __('Next') }}
                                </button>
                            </div>
                        </div> -->

                        {{--  Next button  --}}
                            <div class="row mb-0">
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-orange text-white btn-block mb-2">
                                        {{ __('Next') }}
                                    </button>
                                </div>

                        </div>

                        {{--  Horizontal line  --}}
                        <div class="text-divider text-muted">or</div>

                        {{--  Facebook Logo  --}}
                        <!-- <div class="container justify-content-center logo-center">
                            <a class="" href="#">
                                <img class="icon-sm justify-content-center mt-3" src="{{asset('img/btn_facebook.svg')}}" alt="">
                            </a>
                        </div> -->
                        <div class="d-grid gap-2 mt-3">
                                <a class="btn btn-primary btn-block mb-2 border-0" style="background-color: #1877F2;" href="#!" role="button"><i class="fab fa-facebook me-2"></i>Facebook</a>
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
