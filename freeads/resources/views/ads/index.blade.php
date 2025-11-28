@extends('layouts.app')

@section('title', 'Browse Ads')

@section('content')
    <div class="flex" style="justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2>Latest Ads</h2>
        @auth
            <a href="{{ route('ads.create') }}" class="btn btn-primary">Post an Ad</a>
        @endauth
    </div>

    <!-- Search & Filter Form -->
    <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
        <form action="{{ route('ads.index') }}" method="GET" class="flex"
            style="gap: 1rem; flex-wrap: wrap; align-items: flex-end;">
            <div style="flex: 1; min-width: 200px;">
                <label for="search" style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search ads..."
                    style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="min-width: 150px;">
                <label for="category" style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Category</label>
                <select name="category" id="category"
                    style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">All Categories</option>
                    @foreach(['Electronics', 'Vehicles', 'Furniture', 'Fashion', 'Books', 'Other'] as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div style="min-width: 100px;">
                <label for="min_price" style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Min Price</label>
                <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" placeholder="0"
                    style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="min-width: 100px;">
                <label for="max_price" style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Max Price</label>
                <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" placeholder="Max"
                    style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div>
                <button type="submit" class="btn btn-primary" style="cursor: pointer;">Filter</button>
                <a href="{{ route('ads.index') }}" class="btn" style="margin-left: 0.5rem;">Reset</a>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
        @forelse($ads as $ad)
            <x-ad-card :ad="$ad" />
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 4rem; color: #666;">
                <p>No ads found. Be the first to post one!</p>
            </div>
        @endforelse
    </div>

    <div style="margin-top: 2rem;">
        {{ $ads->links() }}
    </div>
@endsection