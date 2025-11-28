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
            <div style="border: 1px solid #eee; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div
                    style="height: 200px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; color: #aaa;">
                    @if($ad->image_path)
                        <img src="{{ $ad->image_path }}" alt="{{ $ad->title }}"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <span>No Image</span>
                    @endif
                </div>
                <div style="padding: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                        <h3 style="margin: 0; font-size: 1.25rem;">
                            <a href="{{ route('ads.show', $ad) }}"
                                style="text-decoration: none; color: #333;">{{ $ad->title }}</a>
                        </h3>
                        <span style="font-weight: bold; color: #007bff;">${{ number_format($ad->price, 2) }}</span>
                    </div>
                    <p style="color: #666; font-size: 0.875rem; margin-bottom: 1rem;">
                        {{ Str::limit($ad->description, 100) }}
                    </p>
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; font-size: 0.875rem; color: #888;">
                        <span>{{ $ad->location }}</span>
                        <span>{{ $ad->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
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