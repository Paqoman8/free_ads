@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex" style="justify-content: center; padding-top: 2rem;">
        <div style="width: 100%; max-width: 400px; border: 1px solid #eee; padding: 2rem; border-radius: 8px;">
            <h2 style="text-align: center; margin-bottom: 1.5rem;">Login</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div style="margin-bottom: 1rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem;">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    @error('email')
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

                <!-- Remember Me -->
                <div style="margin-bottom: 1.5rem; display: flex; align-items: center;">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                        style="margin-right: 0.5rem;">
                    <label for="remember">Remember Me</label>
                </div>

                <div style="margin-bottom: 1rem;">
                    <button type="submit" class="btn btn-primary" style="width: 100%; cursor: pointer;">
                        Login
                    </button>
                </div>

                <div style="text-align: center;">
                    <a href="{{ route('register') }}" style="text-decoration: none; color: #007bff;">Don't have an account?
                        Register</a>
                </div>
            </form>
        </div>
    </div>
@endsection