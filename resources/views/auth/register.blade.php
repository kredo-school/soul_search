@extends('layouts.app')

@section('styles')
<link href="{{ mix('css/register.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endsection

@section('title','Create Account')

@section('content')

    <img src="{{ asset('images/logo.svg')}}" class="float-left mt-2 ms-4 icon-md">

    <h1 class="text-center fw-bold">
        Create Your Account
    </h1>

{{--  Card body  --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="form-section" id="first-form">
                        <div class="row justify-content-center">
                            <div class="col-8 mb-3 rounded-box btn-orange">
                                <span class="col-5 text-center text-orange rounded-box btn-white ">Profile</span>
                                <span class="col-5 text-end text-white rounded-box">Tags</span>
                            </div>
                        </div>

                        <h2 class="text-center fw-bold mt-2">Your Profile</h2>
                        <p class="text-muted text-center mt-2">Enter the login information for your account.<br>You can edit it after registering.</p>
                        <form method="POST" action="{{ route('register') }}" class="contact-form" id="contact-form" name="firstForm">
                            @csrf

                            {{--  Username  --}}
                            <div class="row mb-3 justify-content-center">
                                <div>
                                    <label for="username" class="text-position">{{ __('Username') }}</label>
                                </div>

                                <div class="col-7">
                                    <input id="username" type="text" class="form-control @error('name') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
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

                                <div class="col-7">
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

                                <div class="col-7">
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

                                <div class="col-7">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                            <div class="form-section" style="display: none" id="second-form">
                                <div class="row justify-content-center">
                                    <div class="col-8 mb-3 rounded-box btn-orange">
                                        <span class="col-md-5 text-center text-white rounded-box">Profile</span>
                                        <span class="col-md-5 box-right text-center text-orange rounded-box btn-white ">Tags</span>
                                    </div>
                                </div>
                                <h2 class="text-center fw-bold mt-2">Choose Tags</h2>
                                    <p class="text-muted text-center mt-2">What kind of things are you interested in?</p>
                                {{--  Tag1  --}}
                                <div class="row mb-3 justify-content-center">
                                    <div>
                                        <label for="tag_name" class="text-position">Tag1</label>
                                    </div>
                                    <div class="col-7">
                                        <input type="text" name="tag_name[]" id="tag_name1" class="form-control" required="required">
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
                                    <div class="col-7">
                                        <input type="text" name="tag_name[]" id="tag_name2" class="form-control" required="required">
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
                                    <div class="col-7">
                                        <input type="text" name="tag_name[]" id="tag_name3" class="form-control" required="required">
                                        @error('tag_name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{--  Button  --}}
                            <div class="row mb-0 ">
                                <div class="col-md-7 button-adjust">
                                    <div class="form-navigation">
                                        <button type="button" class="previous btn btn-primary text-white mb-3 float-start button-right" style="display: none" id="previousbtn" onclick="previous()">&lt; Previous</button>
                                        <button type="button" class="next btn btn-orange text-white mb-3 float-end" id="nextbtn" onclick="next()">Next &gt;</button>
                                        <button type="submit" class="btn btn-orange text-white mb-3 float-end" id="submitbtn" style="display: none">
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
                                <img class="icon-sm justify-content-center mt-3" src="{{asset('images/btn_facebook.svg')}}" alt="">
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

<script src="{{ mix('js/registration.js') }}"></script>
@endsection


