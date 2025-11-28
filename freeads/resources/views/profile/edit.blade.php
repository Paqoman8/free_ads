@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="flex" style="justify-content: center;">
        <div style="width: 100%; max-width: 600px; border: 1px solid #eee; padding: 2rem; border-radius: 8px;">
            <h2 style="margin-bottom: 1.5rem;">Edit Profile</h2>

            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <!-- Login -->
                <div style="margin-bottom: 1rem;">
                    <label for="login" style="display: block; margin-bottom: 0.5rem;">Username</label>
                    <input id="login" type="text" name="login" value="{{ old('login', $user->login) }}" required
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    @error('login')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div style="margin-bottom: 1rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem;">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    @error('email')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div style="margin-bottom: 1rem;">
                    <label for="phone_number" style="display: block; margin-bottom: 0.5rem;">Phone Number</label>
                    <input id="phone_number" type="text" name="phone_number"
                        value="{{ old('phone_number', $user->phone_number) }}"
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    @error('phone_number')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <hr style="margin: 2rem 0; border: 0; border-top: 1px solid #eee;">
                <h3 style="margin-bottom: 1rem; font-size: 1.1rem;">Change Password (Optional)</h3>

                <!-- Password -->
                <div style="margin-bottom: 1rem;">
                    <label for="password" style="display: block; margin-bottom: 0.5rem;">New Password</label>
                    <input id="password" type="password" name="password"
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    @error('password')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div style="margin-bottom: 1.5rem;">
                    <label for="password_confirmation" style="display: block; margin-bottom: 0.5rem;">Confirm New
                        Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div class="flex" style="gap: 1rem;">
                    <button type="submit" class="btn btn-primary" style="cursor: pointer;">Update Profile</button>
                    <a href="{{ route('home') }}" class="btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection