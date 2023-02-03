@extends('layouts.auth')

@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h5 class="nk-block-title">Register</h5>
        <div class="nk-block-des">
            <p>Create New {{ config('app.name', 'Laravel') }} Account</p>
        </div>
    </div>
</div>
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group">
        <label class="form-label" for="username">{{ __('Username') }}</label>
        <div class="form-control-wrap">
            <input id="username" type="text" placeholder="Enter your username" class="form-control form-control-lg @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
        </div>
        @error('username')
            <small class="text-danger" role="alert">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="email">{{ __('Email Address') }}</label>
        <div class="form-control-wrap">
            <input id="email" type="email" placeholder="Enter your email address" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        </div>
        @error('email')
            <small class="text-danger" role="alert">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label class="form-label" for="password">{{ __('Password') }}</label>
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input id="password" type="password" placeholder="Enter your password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        </div>
        @error('password')
            <small class="text-danger" role="alert">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password-confirm">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input id="password-confirm" type="password" placeholder="Enter your confirm password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="confirm-password">
        </div>
    </div>

    <div class="form-group">
        <label class="form-label" for="referral">{{ __('Referral Code') }}</label>
        <div class="form-control-wrap">
            <input id="referral" type="text" placeholder="Enter your referral" class="form-control form-control-lg @error('referral') is-invalid @enderror" name="referral" value="{{ old('referral') }}" autocomplete="referral">
        </div>
        @error('referral')
            <small class="text-danger" role="alert">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <div class="custom-control custom-control-xs custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="checkbox">
            <label class="custom-control-label" for="checkbox">I agree to <a tabindex="-1" href="#">Privacy Policy</a> &amp; <a tabindex="-1" href="#"> Terms.</a></label>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">Register</button>
    </div>
</form><!-- form -->
<div class="form-note-s2 pt-4"> Already have an account ?
    <a href="{{ route('login') }}">
        <strong>Sign in instead</strong>
    </a>
</div>
@endsection

@push('script')

@endpush
