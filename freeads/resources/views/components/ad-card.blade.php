@props(['ad'])

<div
    style="border: 1px solid #eee; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.05); transition: transform 0.2s; background: white;">
    <div
        style="height: 200px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; color: #aaa; overflow: hidden;">
        @if($ad->image_path)
            <img src="{{ $ad->image_path }}" alt="{{ $ad->title }}" style="width: 100%; height: 100%; object-fit: cover;">
        @else
            <span style="font-size: 0.9rem;">No Image</span>
        @endif
    </div>
    <div style="padding: 1.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
            <h3 style="margin: 0; font-size: 1.1rem; line-height: 1.4;">
                <a href="{{ route('ads.show', $ad) }}" style="text-decoration: none; color: #333; font-weight: 600;">
                    {{ Str::limit($ad->title, 40) }}
                </a>
            </h3>
            <span style="font-weight: bold; color: #007bff; white-space: nowrap; margin-left: 0.5rem;">
                ${{ number_format($ad->price, 2) }}
            </span>
        </div>

        <div
            style="margin-bottom: 1rem; font-size: 0.8rem; color: #888; text-transform: uppercase; letter-spacing: 0.5px;">
            {{ $ad->category }}
        </div>

        <div
            style="display: flex; justify-content: space-between; align-items: center; font-size: 0.875rem; color: #666; border-top: 1px solid #f0f0f0; padding-top: 1rem; margin-top: 1rem;">
            <span style="display: flex; align-items: center; gap: 0.25rem;">
                📍 {{ Str::limit($ad->location, 15) }}
            </span>
            <a href="{{ route('ads.show', $ad) }}"
                style="color: #007bff; text-decoration: none; font-weight: 500; font-size: 0.875rem;">
                See Details &rarr;
            </a>
        </div>
    </div>
</div>