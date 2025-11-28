@extends('layouts.app')

@section('title', 'Post an Ad')

@section('content')
    <div class="container" style="margin-top: 32px; margin-bottom: 64px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <!-- Page Header -->
            <div style="text-align: center; margin-bottom: 40px;">
                <h1 style="margin-bottom: 8px;">Post a New Ad</h1>
                <p style="color: var(--color-text-body); margin: 0;">Fill in the details below to create your listing</p>
            </div>

            <form method="POST" action="{{ route('ads.store') }}">
                @csrf

                <div style="display: grid; gap: 24px;">
                    <!-- Basic Information Card -->
                    <div class="card" style="padding: 32px;">
                        <h2 style="margin-bottom: 24px; font-size: 20px;">Basic Information</h2>

                        <div style="display: grid; gap: 20px;">
                            <!-- Title -->
                            <div>
                                <label for="title">Ad Title *</label>
                                <input id="title" type="text" name="title" value="{{ old('title') }}" required autofocus
                                    placeholder="e.g., iPhone 13 Pro Max 256GB">
                                @error('title')
                                    <span
                                        style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                                <small
                                    style="color: var(--color-text-body); font-size: 13px; display: block; margin-top: 4px;">
                                    Choose a clear, descriptive title
                                </small>
                            </div>

                            <!-- Category & Condition Row -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                <div>
                                    <label for="category">Category *</label>
                                    <select id="category" name="category" required>
                                        <option value="">Select a Category</option>
                                        <option value="Electronics" {{ old('category') == 'Electronics' ? 'selected' : '' }}>
                                            📱 Electronics</option>
                                        <option value="Vehicles" {{ old('category') == 'Vehicles' ? 'selected' : '' }}>🚗
                                            Vehicles</option>
                                        <option value="Furniture" {{ old('category') == 'Furniture' ? 'selected' : '' }}>🛋️
                                            Furniture</option>
                                        <option value="Fashion" {{ old('category') == 'Fashion' ? 'selected' : '' }}>👕
                                            Fashion</option>
                                        <option value="Books" {{ old('category') == 'Books' ? 'selected' : '' }}>📚 Books
                                        </option>
                                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>📦 Other
                                        </option>
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
                                        <option value="New" {{ old('condition') == 'New' ? 'selected' : '' }}>New</option>
                                        <option value="Like New" {{ old('condition') == 'Like New' ? 'selected' : '' }}>Like
                                            New</option>
                                        <option value="Good" {{ old('condition') == 'Good' ? 'selected' : '' }}>Good</option>
                                        <option value="Fair" {{ old('condition') == 'Fair' ? 'selected' : '' }}>Fair</option>
                                        <option value="Poor" {{ old('condition') == 'Poor' ? 'selected' : '' }}>Poor</option>
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
                                <textarea id="description" name="description" rows="6" required
                                    placeholder="Describe your item in detail. Include features, condition, reason for selling, etc.">{{ old('description') }}</textarea>
                                @error('description')
                                    <span
                                        style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                @enderror
                                <small
                                    style="color: var(--color-text-body); font-size: 13px; display: block; margin-top: 4px;">
                                    Be honest and detailed to attract serious buyers
                                </small>
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
                                        <input id="price" type="number" step="0.01" name="price" value="{{ old('price') }}"
                                            required placeholder="0.00" style="padding-left: 28px;">
                                    </div>
                                    @error('price')
                                        <span
                                            style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="location">Location *</label>
                                    <input id="location" type="text" name="location" value="{{ old('location') }}" required
                                        placeholder="e.g., New York, NY">
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
                        <h2 style="margin-bottom: 24px; font-size: 20px;">Add Photos</h2>

                        <div>
                            <label for="image_path">Image URL</label>
                            <input id="image_path" type="url" name="image_path" value="{{ old('image_path') }}"
                                placeholder="https://example.com/image.jpg">
                            @error('image_path')
                                <span
                                    style="color: var(--color-error); font-size: 14px; display: block; margin-top: 4px;">{{ $message }}</span>
                            @enderror
                            <small style="color: var(--color-text-body); font-size: 13px; display: block; margin-top: 4px;">
                                Optional: Enter a direct link to an image (temporary solution)
                            </small>
                        </div>

                        <!-- Image Preview -->
                        <div id="imagePreview" style="margin-top: 16px; display: none;">
                            <div
                                style="background: var(--color-bg-light); border-radius: 8px; padding: 16px; text-align: center;">
                                <img id="previewImg" src="" alt="Preview"
                                    style="max-width: 100%; max-height: 300px; border-radius: 6px;">
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="card" style="padding: 24px; background: var(--color-bg-light);">
                        <div style="display: flex; gap: 12px; justify-content: flex-end;">
                            <a href="{{ route('ads.index') }}" class="btn btn-outline">Cancel</a>
                            <button type="submit" class="btn btn-secondary"
                                style="padding-left: 32px; padding-right: 32px;">
                                Publish Ad
                            </button>
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
                imagePreview.style.display = 'none';
            }
        });

        // Trigger preview on page load if there's an old value
        if (imageInput.value) {
            imageInput.dispatchEvent(new Event('input'));
        }
    </script>
@endsection