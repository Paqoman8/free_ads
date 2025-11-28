@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div style="min-height: 60vh; display: flex; align-items: center; justify-content: center; padding: 40px 16px;">
        <div class="card" style="width: 100%; max-width: 480px; padding: 48px;">
            <!-- Header -->
            <div style="text-align: center; margin-bottom: 32px;">
                <h1 style="margin-bottom: 8px;">Create Account</h1>
                <p style="color: var(--color-text-body); margin: 0;">Join FreeAds and start posting ads</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Username -->
                <div style="margin-bottom: 20px;">
                    <label for="login">Username</label>
                    <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus
                        placeholder="Choose a username">
                    @error('login')
                        <span
                            style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div style="margin-bottom: 20px;">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        placeholder="your@email.com">
                    @error('email')
                        <span
                            style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div style="margin-bottom: 20px;">
                    <label for="phone_number">Phone Number</label>
                    <input id="phone_number" type="tel" name="phone_number" value="{{ old('phone_number') }}" required
                        placeholder="+1 (555) 000-0000">
                    @error('phone_number')
                        <span
                            style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom: 20px;">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required placeholder="At least 8 characters">
                    @error('password')
                        <span
                            style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                    @enderror
                    <small style="color: var(--color-text-body); font-size: 13px; display: block; margin-top: 4px;">
                        Must be at least 8 characters long
                    </small>
                </div>

                <!-- Confirm Password -->
                <div style="margin-bottom: 24px;">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        placeholder="Re-enter your password">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-secondary" style="width: 100%; margin-bottom: 16px;">
                    Create Account
                </button>

                <!-- Divider -->
                <div style="text-align: center; margin: 24px 0; position: relative;">
                    <span
                        style="background: white; padding: 0 16px; color: var(--color-text-body); font-size: 14px; position: relative; z-index: 1;">
                        Already have an account?
                    </span>
                    <div
                        style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: var(--color-border); z-index: 0;">
                    </div>
                </div>

                <!-- Login Link -->
                <a href="{{ route('login') }}" class="btn btn-outline"
                    style="width: 100%; display: block; text-align: center;">
                    Login Instead
                </a>
            </form>
        </div>
    </div>
@endsection