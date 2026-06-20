@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')

  <div class="auth-title">Forgot Your Password?</div>
  <div class="auth-subtitle">Enter your email and we'll send you a reset link</div>

  @if (session('status'))
    <div class="auth-alert success">{{ session('status') }}</div>
  @endif
  @if ($errors->any())
    <div class="auth-alert error">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('password.email') }}" class="auth-form">
    @csrf
    <div class="form-group">
      <label>Email Address</label>
      <input type="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required autofocus />
    </div>
    <button type="submit" class="btn btn-primary btn-full">Send Reset Link</button>
  </form>

  <div class="auth-footer">
    Remember your password? <a href="{{ route('login') }}">Back to log in</a>
  </div>

@endsection
