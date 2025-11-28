@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="flex" style="justify-content: center; padding-top: 2rem;">
        <div style="width: 100%; max-width: 400px; border: 1px solid #eee; padding: 2rem; border-radius: 8px;">
            <h2 style="text-align: center; margin-bottom: 1.5rem;">Register</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Login -->
                <div style="margin-bottom: 1rem;">
                    <label for="login" style="display: block; margin-bottom: 0.5rem;">Username</label>
                    <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    @error('login')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div style="margin-bottom: 1rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem;">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    @error('email')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div style="margin-bottom: 1rem;">
                    <label for="phone_number" style="display: block; margin-bottom: 0.5rem;">Phone Number</label>
                    <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}" required
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    @error('phone_number')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom: 1rem;">
                    <label for="password" style="display: block; margin-bottom: 0.5rem;">Password</label>
                    <input id="password" type="password" name="password" required
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    @error('password')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div style="margin-bottom: 1.5rem;">
                    <label for="password_confirmation" style="display: block; margin-bottom: 0.5rem;">Confirm
                        Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <button type="submit" class="btn btn-primary" style="width: 100%; cursor: pointer;">
                        Register
                    </button>
                </div>

                <div style="text-align: center;">
                    <a href="{{ route('login') }}" style="text-decoration: none; color: #007bff;">Already have an account?
                        Login</a>
                </div>
            </form>
        </div>
    </div>
@endsection