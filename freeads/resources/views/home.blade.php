@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="hero">
        <div class="container">
            <h1>Find Great Deals on Everything</h1>
            <p>Buy and sell used items quickly and safely with FreeAds</p>

            <!-- Search Bar -->
            <div class="search-bar">
                <input type="text" placeholder="What are you looking for?" id="hero-search">
                <select id="hero-category" style="width: 200px;">
                    <option value="">All Categories</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Vehicles">Vehicles</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Fashion">Fashion</option>
                    <option value="Books">Books</option>
                    <option value="Other">Other</option>
                </select>
                <button class="btn btn-secondary" onclick="searchAds()">Search</button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container" style="margin-top: 40px;">
        <!-- Quick Stats or Categories -->
        <div style="text-align: center; margin-bottom: 48px;">
            <h2>Browse by Category</h2>
            <p style="color: var(--color-text-body); margin-bottom: 24px;">Find what you need in our popular categories</p>

            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 16px; max-width: 800px; margin: 0 auto;">
                <a href="{{ route('ads.index', ['category' => 'Electronics']) }}" class="card"
                    style="padding: 24px; text-align: center; text-decoration: none;">
                    <div style="font-size: 32px; margin-bottom: 8px;">📱</div>
                    <div style="font-weight: 600; color: var(--color-text-title);">Electronics</div>
                </a>
                <a href="{{ route('ads.index', ['category' => 'Vehicles']) }}" class="card"
                    style="padding: 24px; text-align: center; text-decoration: none;">
                    <div style="font-size: 32px; margin-bottom: 8px;">🚗</div>
                    <div style="font-weight: 600; color: var(--color-text-title);">Vehicles</div>
                </a>
                <a href="{{ route('ads.index', ['category' => 'Furniture']) }}" class="card"
                    style="padding: 24px; text-align: center; text-decoration: none;">
                    <div style="font-size: 32px; margin-bottom: 8px;">🛋️</div>
                    <div style="font-weight: 600; color: var(--color-text-title);">Furniture</div>
                </a>
                <a href="{{ route('ads.index', ['category' => 'Fashion']) }}" class="card"
                    style="padding: 24px; text-align: center; text-decoration: none;">
                    <div style="font-size: 32px; margin-bottom: 8px;">👕</div>
                    <div style="font-weight: 600; color: var(--color-text-title);">Fashion</div>
                </a>
            </div>
        </div>

        <!-- Latest Ads Section -->
        <div style="margin-bottom: 48px;">
            <div class="flex justify-between items-center" style="margin-bottom: 24px;">
                <h2>Latest Ads</h2>
                <a href="{{ route('ads.index') }}" class="btn btn-outline">View All</a>
            </div>

            <div class="grid grid-3">
                @php
                    $latestAds = \App\Models\Ad::latest()->take(6)->get();
                @endphp

                @forelse($latestAds as $ad)
                    <x-ad-card :ad="$ad" />
                @empty
                    <div
                        style="grid-column: 1 / -1; text-align: center; padding: 48px; background: white; border-radius: 10px;">
                        <h3 style="margin-bottom: 16px;">No ads yet</h3>
                        <p style="margin-bottom: 24px; color: var(--color-text-body);">Be the first to post an ad!</p>
                        @auth
                            <a href="{{ route('ads.create') }}" class="btn btn-secondary">Post Your First Ad</a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-secondary">Get Started</a>
                        @endauth
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Call to Action -->
        <div class="card"
            style="padding: 48px; text-align: center; background: linear-gradient(135deg, #1A73E8 0%, #1557b0 100%); color: white; margin-bottom: 48px;">
            <h2 style="color: white; margin-bottom: 16px;">Ready to sell something?</h2>
            <p style="font-size: 18px; margin-bottom: 24px; opacity: 0.95;">Post your ad in minutes and reach thousands of
                buyers</p>
            @auth
                <a href="{{ route('ads.create') }}" class="btn btn-secondary" style="font-size: 18px; padding: 14px 28px;">Post
                    an Ad Now</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-secondary" style="font-size: 18px; padding: 14px 28px;">Sign Up
                    Free</a>
            @endauth
        </div>
    </div>

    <script>
        function searchAds() {
            const search = document.getElementById('hero-search').value;
            const category = document.getElementById('hero-category').value;
            let url = '{{ route("ads.index") }}?';
            if (search) url += 'search=' + encodeURIComponent(search) + '&';
            if (category) url += 'category=' + encodeURIComponent(category);
            window.location.href = url;
        }

        document.getElementById('hero-search').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') searchAds();
        });
    </script>
@endsection