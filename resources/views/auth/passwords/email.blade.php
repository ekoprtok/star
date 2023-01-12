@extends('layouts.auth')

@section('content')
<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h5 class="nk-block-title">Reset password</h5>
        <div class="nk-block-des">
            <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
        </div>
    </div>
</div>
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="default-01">{{ __('Email Address') }}</label>
        </div>
        <div class="form-control-wrap">
            <input id="email" type="email" placeholder="Enter your email address" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        @error('email')
            <small class="text-danger" role="alert">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
    </div>
</form>
<div class="form-note-s2 pt-5">
    <a href="{{ route('login') }}"><strong>Return to login</strong></a>
</div>
@endsection
