<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityImageController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityImage::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Pinned first (desc pin_order = newest pin first), then unpinned by created_at desc
        $images = $query
            ->orderByDesc('is_pinned')
            ->orderByDesc('pin_order')
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.activity-images.index', compact('images'));
    }

    public function create()
    {
        return view('admin.activity-images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
            'is_pinned' => 'nullable|boolean',
        ]);

        $path = $request->file('image')->store('activity-images', 'public');

        $isPinned = $request->boolean('is_pinned');
        $pinOrder = $isPinned ? (ActivityImage::max('pin_order') + 1) : 0;

        ActivityImage::create([
            'title'      => $request->title,
            'image_path' => $path,
            'is_pinned'  => $isPinned,
            'pin_order'  => $pinOrder,
        ]);

        return redirect()->route('admin.activity-images.index')
            ->with('success', 'Image uploaded successfully.');
    }

    public function show(ActivityImage $image)
    {
        return view('admin.activity-images.show', compact('image'));
    }

    public function edit(ActivityImage $image)
    {
        return view('admin.activity-images.edit', compact('image'));
    }

    public function update(Request $request, ActivityImage $image)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'image'     => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
            'is_pinned' => 'nullable|boolean',
        ]);

        $imagePath = $image->image_path;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($imagePath);
            $imagePath = $request->file('image')->store('activity-images', 'public');
        }

        $wasPinned  = $image->is_pinned;
        $isPinned   = $request->boolean('is_pinned');

        // Assign a new pin_order only when transitioning from unpinned → pinned
        $pinOrder = $image->pin_order;
        if ($isPinned && !$wasPinned) {
            $pinOrder = ActivityImage::max('pin_order') + 1;
        } elseif (!$isPinned) {
            $pinOrder = 0;
        }

        $image->update([
            'title'      => $request->title,
            'image_path' => $imagePath,
            'is_pinned'  => $isPinned,
            'pin_order'  => $pinOrder,
        ]);

        return redirect()->route('admin.activity-images.index')
            ->with('success', 'Image updated successfully.');
    }

    public function destroy(ActivityImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->route('admin.activity-images.index')
            ->with('success', 'Image deleted successfully.');
    }

    /**
     * Toggle pinned status. Latest pinned always gets the highest pin_order
     * so it appears first when sorted by pin_order DESC.
     */
    public function togglePin(ActivityImage $image)
    {
        if ($image->is_pinned) {
            // Unpin
            $image->update(['is_pinned' => false, 'pin_order' => 0]);
        } else {
            // Pin — assign next highest order (latest pin = highest = shown first)
            $maxOrder = ActivityImage::max('pin_order') + 1;
            $image->update(['is_pinned' => true, 'pin_order' => $maxOrder]);
        }

        return back()->with('success', $image->is_pinned
            ? 'Image pinned.'
            : 'Image unpinned.');
    }
}
