@extends('layouts.app')

@section('title', 'Browse Ads')

@section('content')
    <div class="container" style="margin-top: 32px;">
        <!-- Page Header -->
        <div class="flex justify-between items-center" style="margin-bottom: 32px;">
            <div>
                <h1 style="margin-bottom: 8px;">Browse Ads</h1>
                <p style="color: var(--color-text-body); margin: 0;">
                    {{ $ads->total() }} {{ Str::plural('ad', $ads->total()) }} available
                </p>
            </div>
            @auth
                <a href="{{ route('ads.create') }}" class="btn btn-secondary">Post an Ad</a>
            @endauth
        </div>

        <!-- Search & Filter Form -->
        <div class="card" style="padding: 24px; margin-bottom: 32px;">
            <!-- Mobile Filter Toggle -->
            <button onclick="toggleFilters()" class="show-mobile btn btn-outline"
                style="width: 100%; margin-bottom: 16px; display: none;">
                🔍 Show Filters
            </button>

            <form action="{{ route('ads.index') }}" method="GET" id="filterForm" class="filter-form flex"
                style="gap: 16px; flex-wrap: wrap; align-items: flex-end;">
                <div style="flex: 1; min-width: 200px;">
                    <label for="search">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Search ads...">
                </div>

                <div style="min-width: 150px;">
                    <label for="category">Category</label>
                    <select name="category" id="category">
                        <option value="">All Categories</option>
                        @foreach(['Electronics', 'Vehicles', 'Furniture', 'Fashion', 'Books', 'Other'] as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="min-width: 120px;">
                    <label for="min_price">Min Price</label>
                    <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}"
                        placeholder="$0">
                </div>

                <div style="min-width: 120px;">
                    <label for="max_price">Max Price</label>
                    <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}"
                        placeholder="Any">
                </div>

                <div style="display: flex; gap: 8px; width: 100%;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Search</button>
                    <a href="{{ route('ads.index') }}" class="btn btn-outline"
                        style="flex: 1; text-align: center;">Reset</a>
                </div>
            </form>
        </div>

        <script>
            function toggleFilters() {
                const form = document.getElementById('filterForm');
                const button = event.target;
                if (form.style.display === 'none') {
                    form.style.display = 'flex';
                    button.textContent = '🔍 Hide Filters';
                } else {
                    form.style.display = 'none';
                    button.textContent = '🔍 Show Filters';
                }
            }

            // Hide filters by default on mobile
            if (window.innerWidth <= 768) {
                document.getElementById('filterForm').style.display = 'none';
            }
        </script>

        <!-- Active Filters Display -->
        @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
            <div style="margin-bottom: 24px; display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
                <span style="font-weight: 500; color: var(--color-text-title);">Active filters:</span>
                @if(request('search'))
                    <span style="background: var(--color-bg-light); padding: 6px 12px; border-radius: 6px; font-size: 14px;">
                        Search: "{{ request('search') }}"
                    </span>
                @endif
                @if(request('category'))
                    <span style="background: var(--color-bg-light); padding: 6px 12px; border-radius: 6px; font-size: 14px;">
                        Category: {{ request('category') }}
                    </span>
                @endif
                @if(request('min_price'))
                    <span style="background: var(--color-bg-light); padding: 6px 12px; border-radius: 6px; font-size: 14px;">
                        Min: ${{ number_format(request('min_price'), 2) }}
                    </span>
                @endif
                @if(request('max_price'))
                    <span style="background: var(--color-bg-light); padding: 6px 12px; border-radius: 6px; font-size: 14px;">
                        Max: ${{ number_format(request('max_price'), 2) }}
                    </span>
                @endif
            </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
            <div
                style="background: #d4f4dd; color: #0f5132; padding: 16px; border-radius: 8px; margin-bottom: 24px; border-left: 4px solid var(--color-success);">
                {{ session('success') }}
            </div>
        @endif

        <!-- Ads Grid -->
        <div class="grid grid-3">
            @forelse($ads as $ad)
                <x-ad-card :ad="$ad" />
            @empty
                <div
                    style="grid-column: 1 / -1; text-align: center; padding: 64px 24px; background: white; border-radius: 10px;">
                    <div style="font-size: 48px; margin-bottom: 16px;">🔍</div>
                    <h3 style="margin-bottom: 16px;">No ads found</h3>
                    <p style="color: var(--color-text-body); margin-bottom: 24px;">
                        @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
                            Try adjusting your filters to find what you're looking for.
                        @else
                            Be the first to post an ad!
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
                        <a href="{{ route('ads.index') }}" class="btn btn-primary">Clear Filters</a>
                    @else
                        @auth
                            <a href="{{ route('ads.create') }}" class="btn btn-secondary">Post Your First Ad</a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-secondary">Get Started</a>
                        @endauth
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($ads->hasPages())
            <div style="margin-top: 48px; display: flex; justify-content: center;">
                {{ $ads->links() }}
            </div>
        @endif
    </div>
@endsection