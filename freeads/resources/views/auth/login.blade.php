@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div style="min-height: 60vh; display: flex; align-items: center; justify-content: center; padding: 40px 16px;">
        <div class="card" style="width: 100%; max-width: 480px; padding: 48px;">
            <!-- Header -->
            <div style="text-align: center; margin-bottom: 32px;">
                <h1 style="margin-bottom: 8px;">Welcome Back</h1>
                <p style="color: var(--color-text-body); margin: 0;">Login to your FreeAds account</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div style="margin-bottom: 20px;">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="your@email.com">
                    @error('email')
                        <span
                            style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom: 20px;">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required placeholder="Enter your password">
                    @error('password')
                        <span
                            style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div style="margin-bottom: 24px; display: flex; align-items: center;">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                        style="width: auto; margin-right: 8px;">
                    <label for="remember" style="margin: 0; font-weight: 400; cursor: pointer;">Remember me</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 16px;">
                    Login
                </button>

                <!-- Divider -->
                <div style="text-align: center; margin: 24px 0; position: relative;">
                    <span
                        style="background: white; padding: 0 16px; color: var(--color-text-body); font-size: 14px; position: relative; z-index: 1;">
                        Don't have an account?
                    </span>
                    <div
                        style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: var(--color-border); z-index: 0;">
                    </div>
                </div>

                <!-- Register Link -->
                <a href="{{ route('register') }}" class="btn btn-outline"
                    style="width: 100%; display: block; text-align: center;">
                    Create an Account
                </a>
            </form>
        </div>
    </div>
@endsection