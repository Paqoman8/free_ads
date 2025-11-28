@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
    <div class="flex" style="justify-content: center; padding-top: 2rem;">
        <div
            style="width: 100%; max-width: 600px; border: 1px solid #eee; padding: 2rem; border-radius: 8px; text-align: center;">
            <h2 style="margin-bottom: 1.5rem;">Verify Your Email Address</h2>

            @if (session('message'))
                <div style="color: green; margin-bottom: 1rem;">
                    {{ session('message') }}
                </div>
            @endif

            <p style="margin-bottom: 1.5rem;">
                Before proceeding, please check your email for a verification link.
                If you did not receive the email, click the button below to request another.
            </p>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary" style="cursor: pointer;">
                    Resend Verification Email
                </button>
            </form>
        </div>
    </div>
@endsection