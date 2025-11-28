@extends('layouts.app')

@section('title', 'My Ads')

@section('content')
    <div class="container" style="margin-top: 32px;">
        <!-- Page Header -->
        <div class="flex justify-between items-center" style="margin-bottom: 32px;">
            <div>
                <h1 style="margin-bottom: 8px;">My Ads</h1>
                <p style="color: var(--color-text-body); margin: 0;">
                    {{ $ads->total() }} {{ Str::plural('ad', $ads->total()) }} posted
                </p>
            </div>
            <a href="{{ route('ads.create') }}" class="btn btn-secondary">Post New Ad</a>
        </div>

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
                <div class="card">
                    <!-- Image -->
                    <div
                        style="height: 200px; background: var(--color-bg-light); display: flex; align-items: center; justify-content: center; color: #aaa; overflow: hidden; position: relative;">
                        @if($ad->image_path)
                            <img src="{{ $ad->image_path }}" alt="{{ $ad->title }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <span style="font-size: 14px;">No Image</span>
                        @endif

                        <!-- Status Badge -->
                        <div
                            style="position: absolute; top: 12px; right: 12px; background: var(--color-success); color: white; padding: 4px 12px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                            Active
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="flex justify-between items-start" style="margin-bottom: 8px;">
                            <h3 style="margin: 0; font-size: 18px; font-weight: 600; line-height: 1.4; flex: 1;">
                                <a href="{{ route('ads.show', $ad) }}" style="color: var(--color-text-title);">
                                    {{ Str::limit($ad->title, 40) }}
                                </a>
                            </h3>
                            <span class="card-price" style="white-space: nowrap; margin-left: 12px;">
                                ${{ number_format($ad->price, 2) }}
                            </span>
                        </div>

                        <!-- Meta Info -->
                        <div style="margin-bottom: 16px; font-size: 13px; color: var(--color-text-body);">
                            <span
                                style="text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500;">{{ $ad->category }}</span>
                            <span style="margin: 0 8px; color: var(--color-border);">•</span>
                            <span>{{ $ad->created_at->format('M d, Y') }}</span>
                        </div>

                        <!-- Stats -->
                        <div
                            style="display: flex; gap: 16px; margin-bottom: 16px; padding: 12px; background: var(--color-bg-light); border-radius: 6px; font-size: 13px;">
                            <div style="flex: 1; text-align: center;">
                                <div style="font-weight: 600; color: var(--color-text-title);">0</div>
                                <div style="color: var(--color-text-body); font-size: 12px;">Views</div>
                            </div>
                            <div
                                style="flex: 1; text-align: center; border-left: 1px solid var(--color-border); border-right: 1px solid var(--color-border);">
                                <div style="font-weight: 600; color: var(--color-text-title);">{{ $ad->location }}</div>
                                <div style="color: var(--color-text-body); font-size: 12px;">Location</div>
                            </div>
                            <div style="flex: 1; text-align: center;">
                                <div style="font-weight: 600; color: var(--color-text-title);">{{ $ad->condition }}</div>
                                <div style="color: var(--color-text-body); font-size: 12px;">Condition</div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('ads.show', $ad) }}" class="btn btn-outline"
                                style="flex: 1; text-align: center; font-size: 14px; padding: 10px;">
                                View
                            </a>
                            <a href="{{ route('ads.edit', $ad) }}" class="btn btn-primary"
                                style="flex: 1; text-align: center; font-size: 14px; padding: 10px;">
                                Edit
                            </a>
                            <form action="{{ route('ads.destroy', $ad) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this ad?');" style="flex: 1;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn"
                                    style="width: 100%; background: var(--color-error); color: white; border: none; cursor: pointer; font-size: 14px; padding: 10px;">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div
                    style="grid-column: 1 / -1; text-align: center; padding: 64px 24px; background: white; border-radius: 10px;">
                    <div style="font-size: 48px; margin-bottom: 16px;">📝</div>
                    <h3 style="margin-bottom: 16px;">No ads yet</h3>
                    <p
                        style="color: var(--color-text-body); margin-bottom: 24px; max-width: 400px; margin-left: auto; margin-right: auto;">
                        You haven't posted any ads yet. Start selling your items by creating your first ad!
                    </p>
                    <a href="{{ route('ads.create') }}" class="btn btn-secondary">Post Your First Ad</a>
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