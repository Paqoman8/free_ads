@extends('layouts.app')

@section('title', 'Edit Ad')

@section('content')
    <div class="container" style="margin-top: 32px; margin-bottom: 64px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <!-- Page Header -->
            <div style="margin-bottom: 32px;">
                <a href="{{ route('ads.show', $ad) }}"
                    style="color: var(--color-text-body); text-decoration: none; font-weight: 500; display: inline-block; margin-bottom: 16px;">
                    ← Back to Ad
                </a>
                <h1 style="margin-bottom: 8px;">Edit Your Ad</h1>
                <p style="color: var(--color-text-body); margin: 0;">Update the details of your listing</p>
            </div>

            <form method="POST" action="{{ route('ads.update', $ad) }}">
                @csrf
                @method('PUT')

                <div style="display: grid; gap: 24px;">
                    <!-- Basic Information Card -->
                    <div class="card" style="padding: 32px;">
                        <h2 style="margin-bottom: 24px; font-size: 20px;">Basic Information</h2>

                        <div style="display: grid; gap: 20px;">
                            <!-- Title -->
                            <div>
                                <label for="title">Ad Title *</label>
                                <input id="title" type="text" name="title" value="{{ old('title', $ad->title) }}" required
                                    autofocus>
                                @error('title')
                                    <span
                                        style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Category & Condition Row -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                <div>
                                    <label for="category">Category *</label>
                                    <select id="category" name="category" required>
                                        <option value="">Select a Category</option>
                                        @foreach(['Electronics', 'Vehicles', 'Furniture', 'Fashion', 'Books', 'Other'] as $cat)
                                            <option value="{{ $cat }}" {{ (old('category', $ad->category) == $cat) ? 'selected' : '' }}>
                                                @if($cat == 'Electronics') 📱
                                                @elseif($cat == 'Vehicles') 🚗
                                                @elseif($cat == 'Furniture') 🛋️
                                                @elseif($cat == 'Fashion') 👕
                                                @elseif($cat == 'Books') 📚
                                                @else 📦
                                                @endif
                                                {{ $cat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span
                                            style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="condition">Condition *</label>
                                    <select id="condition" name="condition" required>
                                        <option value="">Select Condition</option>
                                        @foreach(['New', 'Like New', 'Good', 'Fair', 'Poor'] as $cond)
                                            <option value="{{ $cond }}" {{ (old('condition', $ad->condition) == $cond) ? 'selected' : '' }}>{{ $cond }}</option>
                                        @endforeach
                                    </select>
                                    @error('condition')
                                        <span
                                            style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description">Description *</label>
                                <textarea id="description" name="description" rows="6"
                                    required>{{ old('description', $ad->description) }}</textarea>
                                @error('description')
                                    <span
                                        style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Pricing & Location Card -->
                    <div class="card" style="padding: 32px;">
                        <h2 style="margin-bottom: 24px; font-size: 20px;">Pricing & Location</h2>

                        <div style="display: grid; gap: 20px;">
                            <!-- Price & Location Row -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                <div>
                                    <label for="price">Price (USD) *</label>
                                    <div style="position: relative;">
                                        <span
                                            style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--color-text-body); font-weight: 500;">$</span>
                                        <input id="price" type="number" step="0.01" name="price"
                                            value="{{ old('price', $ad->price) }}" required style="padding-left: 28px;">
                                    </div>
                                    @error('price')
                                        <span
                                            style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="location">Location *</label>
                                    <input id="location" type="text" name="location"
                                        value="{{ old('location', $ad->location) }}" required>
                                    @error('location')
                                        <span
                                            style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image Upload Card -->
                    <div class="card" style="padding: 32px;">
                        <h2 style="margin-bottom: 24px; font-size: 20px;">Update Photo</h2>

                        <div>
                            <label for="image_path">Image URL</label>
                            <input id="image_path" type="url" name="image_path"
                                value="{{ old('image_path', $ad->image_path) }}"
                                placeholder="https://example.com/image.jpg">
                            @error('image_path')
                                <span
                                    style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                            @enderror
                            <small style="color: var(--color-text-body); font-size: 13px; display: block; margin-top: 4px;">
                                Optional: Enter a direct link to an image
                            </small>
                        </div>

                        <!-- Current/Preview Image -->
                        @if($ad->image_path || old('image_path'))
                            <div id="imagePreview" style="margin-top: 16px;">
                                <div
                                    style="background: var(--color-bg-light); border-radius: 8px; padding: 16px; text-align: center;">
                                    <div style="font-size: 13px; color: var(--color-text-body); margin-bottom: 8px;">Current
                                        Image:</div>
                                    <img id="previewImg" src="{{ old('image_path', $ad->image_path) }}" alt="Preview"
                                        style="max-width: 100%; max-height: 300px; border-radius: 6px;">
                                </div>
                            </div>
                        @else
                            <div id="imagePreview" style="margin-top: 16px; display: none;">
                                <div
                                    style="background: var(--color-bg-light); border-radius: 8px; padding: 16px; text-align: center;">
                                    <img id="previewImg" src="" alt="Preview"
                                        style="max-width: 100%; max-height: 300px; border-radius: 6px;">
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Ad Info Card -->
                    <div class="card" style="padding: 24px; background: var(--color-bg-light);">
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; font-size: 14px; color: var(--color-text-body);">
                            <div>
                                <strong>Created:</strong> {{ $ad->created_at->format('M d, Y') }}
                            </div>
                            <div>
                                <strong>Last Updated:</strong> {{ $ad->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="card" style="padding: 24px; background: var(--color-bg-light);">
                        <div style="display: flex; gap: 12px; justify-content: space-between; align-items: center;">
                            <a href="{{ route('ads.show', $ad) }}" class="btn btn-outline">Cancel</a>
                            <div style="display: flex; gap: 12px;">
                                <button type="submit" class="btn btn-primary"
                                    style="padding-left: 32px; padding-right: 32px;">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image preview
        const imageInput = document.getElementById('image_path');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        imageInput.addEventListener('input', function () {
            const url = this.value.trim();
            if (url) {
                previewImg.src = url;
                imagePreview.style.display = 'block';
                previewImg.onerror = function () {
                    imagePreview.style.display = 'none';
                };
            } else {
                @if(!$ad->image_path)
                    imagePreview.style.display = 'none';
                @endif
            }
        });
    </script>
@endsection