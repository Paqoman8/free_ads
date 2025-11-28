<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ad::latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        $ads = $query->paginate(12)->withQueryString();
        return view('ads.index', compact('ads'));
    }

    /**
     * Display the authenticated user's ads.
     */
    public function myAds()
    {
        $ads = auth()->user()->ads()->latest()->paginate(12);
        return view('ads.my-ads', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'condition' => 'required|string|in:New,Like New,Good,Fair,Poor',
            'image_path' => 'nullable|string', // Placeholder for now
        ]);

        $request->user()->ads()->create($validated);

        return redirect()->route('ads.index')->with('success', 'Ad created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ad $ad)
    {
        return view('ads.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ad $ad)
    {
        // Manual check fallback if policy not ready
        if ($ad->user_id !== Auth::id()) {
            abort(403);
        }

        return view('ads.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ad $ad)
    {
        if ($ad->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'condition' => 'required|string|in:New,Like New,Good,Fair,Poor',
            'image_path' => 'nullable|string',
        ]);

        $ad->update($validated);

        return redirect()->route('ads.show', $ad)->with('success', 'Ad updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ad $ad)
    {
        if ($ad->user_id !== Auth::id()) {
            abort(403);
        }

        $ad->delete();

        return redirect()->route('ads.index')->with('success', 'Ad deleted successfully.');
    }
}
