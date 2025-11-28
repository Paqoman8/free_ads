@extends('layouts.app')

@section('title', $ad->title)

@section('content')
    <div class="container" style="margin-top: 32px; margin-bottom: 64px;">
        <!-- Breadcrumb -->
        <div style="margin-bottom: 24px;">
            <a href="{{ route('ads.index') }}"
                style="color: var(--color-text-body); text-decoration: none; font-weight: 500;">
                ← Back to Browse Ads
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div
                style="background: #d4f4dd; color: #0f5132; padding: 16px; border-radius: 8px; margin-bottom: 24px; border-left: 4px solid var(--color-success);">
                {{ session('success') }}
            </div>
        @endif

        <div style="display: grid; grid-template-columns: 1fr 400px; gap: 32px;" class="ad-detail-grid">
            <!-- Main Content -->
            <div>
                <!-- Image Gallery -->
                <div class="card" style="padding: 0; margin-bottom: 24px; overflow: hidden;">
                    <div
                        style="background: var(--color-bg-light); height: 500px; display: flex; align-items: center; justify-content: center; color: #aaa; overflow: hidden;">
                        @if($ad->image_path)
                            <img src="{{ $ad->image_path }}" alt="{{ $ad->title }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="text-align: center;">
                                <div style="font-size: 64px; margin-bottom: 16px;">📷</div>
                                <div style="font-size: 16px; color: var(--color-text-body);">No Image Available</div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Description Card -->
                <div class="card" style="padding: 32px;">
                    <h2 style="margin-bottom: 16px; font-size: 20px;">Description</h2>
                    <p style="line-height: 1.8; color: var(--color-text-body); white-space: pre-line;">
                        {{ $ad->description }}
                    </p>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Price & Title Card -->
                <div class="card" style="padding: 32px; margin-bottom: 24px;">
                    <div style="margin-bottom: 24px;">
                        <h1 style="font-size: 28px; margin-bottom: 16px; line-height: 1.3;">{{ $ad->title }}</h1>
                        <div style="font-size: 36px; font-weight: 700; color: var(--color-primary);">
                            ${{ number_format($ad->price, 2) }}
                        </div>
                    </div>

                    <!-- Category Badge -->
                    <div
                        style="display: inline-block; background: var(--color-bg-light); padding: 6px 12px; border-radius: 6px; font-size: 14px; font-weight: 500; color: var(--color-text-title); margin-bottom: 24px;">
                        {{ $ad->category }}
                    </div>

                    <!-- Details List -->
                    <div style="border-top: 1px solid var(--color-border); padding-top: 24px;">
                        <div style="display: grid; gap: 16px;">
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: var(--color-text-body);">Condition</span>
                                <span style="font-weight: 600; color: var(--color-text-title);">{{ $ad->condition }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: var(--color-text-body);">Location</span>
                                <span style="font-weight: 600; color: var(--color-text-title);">📍
                                    {{ $ad->location }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: var(--color-text-body);">Posted</span>
                                <span
                                    style="font-weight: 600; color: var(--color-text-body);">{{ $ad->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seller Info Card -->
                <div class="card" style="padding: 24px; margin-bottom: 24px;">
                    <h3 style="margin-bottom: 16px; font-size: 16px;">Seller Information</h3>

                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div
                            style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, var(--color-primary) 0%, #1557b0 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 20px;">
                            {{ strtoupper(substr($ad->user->login, 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight: 600; color: var(--color-text-title);">{{ $ad->user->login }}</div>
                            <div style="font-size: 13px; color: var(--color-text-body);">Member since
                                {{ $ad->user->created_at->format('M Y') }}
                            </div>
                        </div>
                    </div>

                    @if($ad->user->phone_number)
                        <a href="tel:{{ $ad->user->phone_number }}" class="btn btn-primary"
                            style="width: 100%; text-align: center; display: block; margin-bottom: 12px;">
                            📞 Call Seller
                        </a>
                    @endif

                    <a href="mailto:{{ $ad->user->email }}" class="btn btn-outline"
                        style="width: 100%; text-align: center; display: block;">
                        ✉️ Email Seller
                    </a>
                </div>

                <!-- Owner Actions -->
                @if(Auth::check() && Auth::id() === $ad->user_id)
                    <div class="card"
                        style="padding: 24px; background: var(--color-bg-light); border: 2px dashed var(--color-border);">
                        <h3 style="margin-bottom: 16px; font-size: 16px;">Manage Your Ad</h3>

                        <div style="display: grid; gap: 12px;">
                            <a href="{{ route('ads.edit', $ad) }}" class="btn btn-primary"
                                style="width: 100%; text-align: center;">
                                Edit Ad
                            </a>
                            <form action="{{ route('ads.destroy', $ad) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this ad? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn"
                                    style="width: 100%; background: var(--color-error); color: white; border: none; cursor: pointer;">
                                    Delete Ad
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- Safety Tips -->
                <div
                    style="background: #fff3cd; border: 1px solid #ffc107; border-radius: 8px; padding: 16px; margin-top: 24px;">
                    <h4 style="margin-bottom: 8px; font-size: 14px; color: #856404;">⚠️ Safety Tips</h4>
                    <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #856404; line-height: 1.6;">
                        <li>Meet in a public place</li>
                        <li>Check the item before payment</li>
                        <li>Don't send money in advance</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection