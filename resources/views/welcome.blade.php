<!DOCTYPE html>
@extends('layouts.app')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/buttons.css')}}">

    <title>Network</title>
</head>
<body class="antialiased">

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <p><img src="{{asset('assets/images/logo.png')}}" width="400" height="400" class="d-inline-block align-right" style="margin-left: -80px"></p>


            <div class="col-md-6" style="margin-top: 50px; margin-right: -50px">
                <div class="card">
                    <div class="card-header"><p style="height: 10px; margin-left: 200px; font-size: large; font-weight: bold; color:#00508f;">{{ __('Create an Account') }}</p></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="block button button1" type="submit"
                                            style="width: 4cm; height: 1cm; margin-left: 1cm"><span>{{ __('Sign Up') }}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <p style="margin-left: 205px; margin-top: 10px">Already have an account? <a href="{{ url('/login') }}">Log in</a></p>
            </div>
        </div>
    </div>
    @endsection
    </div>
</body>
</html>
