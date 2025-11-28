@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div style="text-align: center; padding: 4rem 0;">
        <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">Welcome to FreeAds</h1>
        <p style="font-size: 1.2rem; color: #666; margin-bottom: 2rem;">The best place to buy and sell used goods.</p>

        <div class="flex" style="justify-content: center; gap: 1rem;">
            <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
            <a href="{{ route('ads.index') }}" class="btn">Browse Ads</a>
        </div>
    </div>
@endsection