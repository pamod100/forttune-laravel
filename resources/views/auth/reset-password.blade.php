@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

  <div class="auth-title">Set a New Password</div>
  <div class="auth-subtitle">Choose a strong password for your account</div>

  @if ($errors->any())
    <div class="auth-alert error">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('password.update') }}" class="auth-form">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">
      <label>Email Address</label>
      <input type="email" name="email" value="{{ old('email', $email) }}" required autofocus />
    </div>
    <div class="form-group">
      <label>New Password</label>
      <input type="password" name="password" placeholder="At least 8 characters" required />
    </div>
    <div class="form-group">
      <label>Confirm New Password</label>
      <input type="password" name="password_confirmation" placeholder="Re-enter new password" required />
    </div>
    <button type="submit" class="btn btn-primary btn-full">Reset Password</button>
  </form>

@endsection
