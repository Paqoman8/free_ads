@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="container" style="margin-top: 32px; margin-bottom: 64px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <!-- Page Header -->
            <div style="margin-bottom: 32px;">
                <h1 style="margin-bottom: 8px;">Profile Settings</h1>
                <p style="color: var(--color-text-body); margin: 0;">Manage your account information and preferences</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div
                    style="background: #d4f4dd; color: #0f5132; padding: 16px; border-radius: 8px; margin-bottom: 24px; border-left: 4px solid var(--color-success);">
                    {{ session('success') }}
                </div>
            @endif

            <div style="display: grid; gap: 24px;">
                <!-- Account Information Card -->
                <div class="card" style="padding: 32px;">
                    <h2 style="margin-bottom: 24px; font-size: 20px;">Account Information</h2>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div style="display: grid; gap: 20px;">
                            <!-- Username -->
                            <div>
                                <label for="login">Username</label>
                                <input id="login" type="text" name="login" value="{{ old('login', $user->login) }}"
                                    required>
                                @error('login')
                                    <span
                                        style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                                <small
                                    style="color: var(--color-text-body); font-size: 13px; display: block; margin-top: 4px;">
                                    This is your public display name
                                </small>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email">Email Address</label>
                                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                                    required>
                                @error('email')
                                    <span
                                        style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                                @if($user->email_verified_at)
                                    <small
                                        style="color: var(--color-success); font-size: 13px; display: block; margin-top: 4px;">
                                        ✓ Verified on {{ $user->email_verified_at->format('M d, Y') }}
                                    </small>
                                @else
                                    <small style="color: var(--color-error); font-size: 13px; display: block; margin-top: 4px;">
                                        Not verified. Check your email for verification link.
                                    </small>
                                @endif
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" type="tel" name="phone_number"
                                    value="{{ old('phone_number', $user->phone_number) }}" placeholder="+1 (555) 000-0000">
                                @error('phone_number')
                                    <span
                                        style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                                <small
                                    style="color: var(--color-text-body); font-size: 13px; display: block; margin-top: 4px;">
                                    Buyers will use this to contact you
                                </small>
                            </div>
                        </div>

                        <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--color-border);">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>

                <!-- Change Password Card -->
                <div class="card" style="padding: 32px;">
                    <h2 style="margin-bottom: 8px; font-size: 20px;">Change Password</h2>
                    <p style="color: var(--color-text-body); margin-bottom: 24px; font-size: 14px;">
                        Leave blank to keep your current password
                    </p>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Hidden fields to preserve other data -->
                        <input type="hidden" name="login" value="{{ $user->login }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="phone_number" value="{{ $user->phone_number }}">

                        <div style="display: grid; gap: 20px;">
                            <!-- New Password -->
                            <div>
                                <label for="password">New Password</label>
                                <input id="password" type="password" name="password" placeholder="At least 8 characters">
                                @error('password')
                                    <span
                                        style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation">Confirm New Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    placeholder="Re-enter your password">
                            </div>
                        </div>

                        <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--color-border);">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>

                <!-- Account Stats Card -->
                <div class="card" style="padding: 32px;">
                    <h2 style="margin-bottom: 24px; font-size: 20px;">Account Statistics</h2>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 24px;">
                        <div
                            style="text-align: center; padding: 16px; background: var(--color-bg-light); border-radius: 8px;">
                            <div
                                style="font-size: 32px; font-weight: 700; color: var(--color-primary); margin-bottom: 4px;">
                                {{ $user->ads()->count() }}
                            </div>
                            <div style="color: var(--color-text-body); font-size: 14px;">Total Ads</div>
                        </div>

                        <div
                            style="text-align: center; padding: 16px; background: var(--color-bg-light); border-radius: 8px;">
                            <div
                                style="font-size: 32px; font-weight: 700; color: var(--color-success); margin-bottom: 4px;">
                                {{ $user->ads()->count() }}
                            </div>
                            <div style="color: var(--color-text-body); font-size: 14px;">Active Ads</div>
                        </div>

                        <div
                            style="text-align: center; padding: 16px; background: var(--color-bg-light); border-radius: 8px;">
                            <div
                                style="font-size: 32px; font-weight: 700; color: var(--color-text-title); margin-bottom: 4px;">
                                {{ $user->created_at->format('M Y') }}
                            </div>
                            <div style="color: var(--color-text-body); font-size: 14px;">Member Since</div>
                        </div>
                    </div>

                    <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--color-border);">
                        <a href="{{ route('ads.my-ads') }}" class="btn btn-outline">View My Ads</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection