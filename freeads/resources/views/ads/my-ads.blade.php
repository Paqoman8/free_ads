@extends('layouts.app')

@section('title', 'My Ads')

@section('content')
    <div class="flex" style="justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2>My Ads</h2>
        <a href="{{ route('ads.create') }}" class="btn btn-primary">Post New Ad</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
        @forelse($ads as $ad)
            <div
                style="border: 1px solid #eee; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.05); background: white;">
                <div
                    style="height: 200px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; color: #aaa; overflow: hidden;">
                    @if($ad->image_path)
                        <img src="{{ $ad->image_path }}" alt="{{ $ad->title }}"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <span style="font-size: 0.9rem;">No Image</span>
                    @endif
                </div>
                <div style="padding: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                        <h3 style="margin: 0; font-size: 1.1rem; line-height: 1.4;">
                            <a href="{{ route('ads.show', $ad) }}"
                                style="text-decoration: none; color: #333; font-weight: 600;">
                                {{ Str::limit($ad->title, 40) }}
                            </a>
                        </h3>
                        <span style="font-weight: bold; color: #007bff; white-space: nowrap; margin-left: 0.5rem;">
                            ${{ number_format($ad->price, 2) }}
                        </span>
                    </div>

                    <div style="margin-bottom: 1rem; font-size: 0.8rem; color: #888;">
                        <span style="text-transform: uppercase; letter-spacing: 0.5px;">{{ $ad->category }}</span>
                        <span style="margin: 0 0.5rem;">•</span>
                        <span>{{ $ad->created_at->format('M d, Y') }}</span>
                    </div>

                    <div
                        style="display: flex; gap: 0.5rem; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #f0f0f0;">
                        <a href="{{ route('ads.show', $ad) }}" class="btn"
                            style="flex: 1; text-align: center; font-size: 0.875rem;">
                            View
                        </a>
                        <a href="{{ route('ads.edit', $ad) }}" class="btn btn-primary"
                            style="flex: 1; text-align: center; font-size: 0.875rem;">
                            Edit
                        </a>
                        <form action="{{ route('ads.destroy', $ad) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this ad?');" style="flex: 1;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn"
                                style="width: 100%; background: #dc3545; color: white; border: none; cursor: pointer; font-size: 0.875rem;">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 4rem; color: #666;">
                <p style="margin-bottom: 1rem;">You haven't posted any ads yet.</p>
                <a href="{{ route('ads.create') }}" class="btn btn-primary">Post Your First Ad</a>
            </div>
        @endforelse
    </div>

    <div style="margin-top: 2rem;">
        {{ $ads->links() }}
    </div>
@endsection