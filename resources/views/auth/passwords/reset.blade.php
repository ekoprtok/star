@extends('layouts.auth')

@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h5 class="nk-block-title">{{ __('Reset Password') }}</h5>
    </div>
</div>
<form method="POST" action="{{ route('password.update') }}" class="form-validate is-alter" autocomplete="off">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="email-address">{{ __('Email Address') }}</label>
        </div>
        <div class="form-control-wrap">
            <input autocomplete="off" id="email" type="email"  placeholder="Enter your email address" value="{{ $email ?? old('email') }}" class="form-control-lg form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        @error('email')
            <small class="text-danger" role="alert">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password">{{ __('Password') }}</label>
        </div>
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input autocomplete="new-password" id="password" type="password" placeholder="Enter your password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required>
        </div>
        @error('password')
                <small class="text-danger" role="alert">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password">{{ __('Confirm Password') }}</label>
        </div>
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password_confirmation">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input autocomplete="new-password" id="password_confirmation" type="password" placeholder="Enter your password" class="form-control form-control-lg " name="password_confirmation" required>
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">{{ __('Reset Password') }}</button>
    </div>
</form>
<div class="form-note-s2 pt-4"> Remember your password? <a href="{{ route('login') }}">Sign In</a>
</div>
@endsection
