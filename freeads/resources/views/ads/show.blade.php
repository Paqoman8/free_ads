@extends('layouts.app')

@section('title', $ad->title)

@section('content')
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('ads.index') }}" style="text-decoration: none; color: #666;">&larr; Back to Ads</a>
    </div>

    <div class="flex" style="gap: 3rem; flex-wrap: wrap;">
        <!-- Image Section -->
        <div style="flex: 1; min-width: 300px;">
            <div
                style="background: #f8f9fa; height: 400px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #aaa; overflow: hidden;">
                @if($ad->image_path)
                    <img src="{{ $ad->image_path }}" alt="{{ $ad->title }}"
                        style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <span style="font-size: 1.5rem;">No Image</span>
                @endif
            </div>
        </div>

        <!-- Details Section -->
        <div style="flex: 1; min-width: 300px;">
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
                    {{ session('success') }}
                </div>
            @endif

            <h1 style="margin-bottom: 0.5rem;">{{ $ad->title }}</h1>
            <div style="font-size: 1.5rem; color: #007bff; font-weight: bold; margin-bottom: 1.5rem;">
                ${{ number_format($ad->price, 2) }}
            </div>

            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                <div style="display: grid; grid-template-columns: auto 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <span style="font-weight: bold; color: #555;">Category:</span>
                    <span>{{ $ad->category }}</span>

                    <span style="font-weight: bold; color: #555;">Condition:</span>
                    <span>{{ $ad->condition }}</span>

                    <span style="font-weight: bold; color: #555;">Location:</span>
                    <span>{{ $ad->location }}</span>

                    <span style="font-weight: bold; color: #555;">Posted by:</span>
                    <span>{{ $ad->user->login ?? 'Unknown' }}</span>

                    <span style="font-weight: bold; color: #555;">Posted:</span>
                    <span>{{ $ad->created_at->format('M d, Y') }}</span>
                </div>

                @if($ad->user->phone_number)
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #ddd;">
                        <span style="font-weight: bold; color: #555;">Contact:</span>
                        <a href="tel:{{ $ad->user->phone_number }}"
                            style="color: #007bff; text-decoration: none;">{{ $ad->user->phone_number }}</a>
                    </div>
                @endif
            </div>

            <div style="margin-bottom: 2rem;">
                <h3 style="margin-bottom: 1rem;">Description</h3>
                <p style="line-height: 1.6; color: #333;">
                    {{ $ad->description }}
                </p>
            </div>

            @can('update', $ad)
                <div class="flex" style="gap: 1rem;">
                    <a href="{{ route('ads.edit', $ad) }}" class="btn btn-primary">Edit Ad</a>
                    <form action="{{ route('ads.destroy', $ad) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this ad?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn"
                            style="background: #dc3545; color: white; border: none; cursor: pointer;">Delete Ad</button>
                    </form>
                </div>
            @else
                @if(Auth::id() === $ad->user_id)
                    <!-- Fallback if policy not working yet -->
                    <div class="flex" style="gap: 1rem;">
                        <a href="{{ route('ads.edit', $ad) }}" class="btn btn-primary">Edit Ad</a>
                        <form action="{{ route('ads.destroy', $ad) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this ad?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn"
                                style="background: #dc3545; color: white; border: none; cursor: pointer;">Delete Ad</button>
                        </form>
                    </div>
                @endif
            @endcan
        </div>
    </div>
@endsection