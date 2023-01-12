@extends('layouts.auth')

@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h5 class="nk-block-title">Sign-In</h5>
        <div class="nk-block-des">
            <p>Access the DashLite panel using your email and password.</p>
        </div>
    </div>
</div>
<form method="POST" action="{{ route('login') }}" class="form-validate is-alter" autocomplete="off">
    @csrf
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="email-address">{{ __('Email Address') }}</label>
        </div>
        <div class="form-control-wrap">
            <input autocomplete="off" id="email" type="email"  placeholder="Enter your email address or username" class="form-control-lg form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        @error('email')
            <small class="text-danger" role="alert">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password">{{ __('Password') }}</label>
            @if (Route::has('password.request'))
                <a class="link link-primary link-sm" tabindex="-1" href="{{ route('password.request') }}">Forgot Passowrd?</a>
            @endif
        </div>
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input autocomplete="new-password" id="password" type="password" placeholder="Enter your password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        </div>
        @error('password')
                <small class="text-danger" role="alert">{{ $message }}</small>
            @enderror
    </div>
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
    </div>
</form>
<div class="form-note-s2 pt-4"> New on our platform? <a href="{{ route('register') }}">Create an account</a>
</div>
@endsection
