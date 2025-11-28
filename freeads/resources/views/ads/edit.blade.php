@extends('layouts.app')

@section('title', 'Edit Ad')

@section('content')
    <div class="flex" style="justify-content: center;">
        <div style="width: 100%; max-width: 600px; border: 1px solid #eee; padding: 2rem; border-radius: 8px;">
            <h2 style="margin-bottom: 1.5rem;">Edit Ad: {{ $ad->title }}</h2>

            <form method="POST" action="{{ route('ads.update', $ad) }}">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div style="margin-bottom: 1rem;">
                    <label for="title" style="display: block; margin-bottom: 0.5rem;">Title</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $ad->title) }}" required autofocus
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    @error('title')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Category -->
                <div style="margin-bottom: 1rem;">
                    <label for="category" style="display: block; margin-bottom: 0.5rem;">Category</label>
                    <select id="category" name="category" required
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="">Select a Category</option>
                        @foreach(['Electronics', 'Vehicles', 'Furniture', 'Fashion', 'Books', 'Other'] as $cat)
                            <option value="{{ $cat }}" {{ (old('category', $ad->category) == $cat) ? 'selected' : '' }}>{{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Price -->
                <div style="margin-bottom: 1rem;">
                    <label for="price" style="display: block; margin-bottom: 0.5rem;">Price ($)</label>
                    <input id="price" type="number" step="0.01" name="price" value="{{ old('price', $ad->price) }}" required
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    @error('price')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Condition -->
                <div style="margin-bottom: 1rem;">
                    <label for="condition" style="display: block; margin-bottom: 0.5rem;">Condition</label>
                    <select id="condition" name="condition" required
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="">Select Condition</option>
                        @foreach(['New', 'Like New', 'Good', 'Fair', 'Poor'] as $cond)
                            <option value="{{ $cond }}" {{ (old('condition', $ad->condition) == $cond) ? 'selected' : '' }}>
                                {{ $cond }}</option>
                        @endforeach
                    </select>
                    @error('condition')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Location -->
                <div style="margin-bottom: 1rem;">
                    <label for="location" style="display: block; margin-bottom: 0.5rem;">Location</label>
                    <input id="location" type="text" name="location" value="{{ old('location', $ad->location) }}" required
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    @error('location')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image URL (Temporary) -->
                <div style="margin-bottom: 1rem;">
                    <label for="image_path" style="display: block; margin-bottom: 0.5rem;">Image URL</label>
                    <input id="image_path" type="text" name="image_path" value="{{ old('image_path', $ad->image_path) }}"
                        placeholder="https://example.com/image.jpg"
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    <small style="color: #666;">(Optional) Enter a direct link to an image.</small>
                    @error('image_path')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div style="margin-bottom: 1.5rem;">
                    <label for="description" style="display: block; margin-bottom: 0.5rem;">Description</label>
                    <textarea id="description" name="description" rows="5" required
                        style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">{{ old('description', $ad->description) }}</textarea>
                    @error('description')
                        <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex" style="gap: 1rem;">
                    <button type="submit" class="btn btn-primary" style="cursor: pointer;">Update Ad</button>
                    <a href="{{ route('ads.show', $ad) }}" class="btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection