@extends('layouts.app')

@section('styles')
<link href="{{ mix('css/register.css') }}" rel="stylesheet">
@endsection

@section('title','Create Account')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{ mix('js/registration.js') }}"></script>

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
                        <div class="col-8 mb-3 rounded-box btn-orange">
                            <span class="col-5 text-center text-orange rounded-box btn-white ">Profile</span>
                            <span class="col-5 text-end text-white rounded-box">Tags</span>
                        </div>
                    </div>

                    <h2 class="text-center fw-bold mt-2">Your Profile</h2>
                    <p class="text-muted text-center mt-2">Enter the login information for your account.<br>You can edit it after registering.</p>
                    <form method="POST" action="{{ route('register') }}" class="contact-form">
                        @csrf

                        <div class="form-section">
                            {{--  Username  --}}
                            <div class="row mb-3 justify-content-center">
                                <div>
                                    <label for="username" class="text-position">{{ __('Username') }}</label>
                                </div>

                                <div class="col-6">
                                    <input id="username" type="text" class="form-control @error('name') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

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
                        </div>

                        <div class="form-section">
                            {{--  Tag1  --}}
                            <div class="row mb-3 justify-content-center">
                                <div>
                                    <label for="tag_name" class="text-position">Tag1</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" name="tag_name[]" id="tag_name" class="form-control" required="required">
                                    @error('tag_name')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            {{--  Tag2  --}}
                            <div class="row mb-3 justify-content-center">
                                <div>
                                    <label for="tag_name" class="text-position">Tag2</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" name="tag_name[]" id="tag_name" class="form-control" required="required">
                                    @error('tag_name')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            {{--  Tag3  --}}
                            <div class="row mb-3 justify-content-center">
                                <div>
                                    <label for="tag_name" class="text-position">Tag3</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" name="tag_name[]" id="tag_name" class="form-control" required="required">
                                    @error('tag_name')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                            {{--  Button  --}}
                            <div class="row mb-0 ">
                                <div class="col-md-6 offset-md-3">
                                    <div class="form-navigation">
                                        <button class="previous btn btn-primary text-white mb-3 float-left">&lt; Previous</button>
                                        <button class="next btn btn-orange text-white mb-3 float-right">Next &gt;</button>
                                        <button type="submit" class="btn btn-orange text-white mb-3 float-right">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>

                        {{--  Horizontal line  --}}
                        <div class="text-divider text-muted">
                            or
                        </div>

                        {{--  Facebook Logo  --}}
                        <div class="container justify-content-center logo-center">
                            <a class="" href="#">
                                <img class="icon-sm justify-content-center mt-3" src="{{asset('img/btn_facebook.svg')}}" alt="">
                            </a>
                        </div>
                        {{--  Message  --}}
                        <p class="mt-3 mb-4 text-center">
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


