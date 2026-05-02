@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <div class="mb-4 flex gap-2">
        <a href="{{ route('admin.activity-images.index') }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back to Gallery
        </a>
        <a href="{{ route('admin.activity-images.edit', $image) }}"
            class="inline-block bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-600 transition">
            Edit
        </a>
    </div>

    <h2 class="text-2xl font-bold mb-2 text-gray-800">{{ $image->title }}</h2>

    <div class="flex items-center gap-3 mb-6">
        @if($image->is_pinned)
            <span class="inline-flex items-center gap-1 px-3 py-1 text-sm font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                📌 Pinned &mdash; Order #{{ $image->pin_order }}
            </span>
        @else
            <span class="inline-flex items-center px-3 py-1 text-sm font-semibold bg-gray-100 text-gray-600 rounded-full">
                Unpinned
            </span>
        @endif
        <span class="text-sm text-gray-400">Uploaded {{ $image->created_at->format('d M Y, H:i') }}</span>
    </div>

    <div class="rounded-xl overflow-hidden border border-gray-200 shadow-md">
        <img src="{{ asset('storage/' . $image->image_path) }}"
             alt="{{ $image->title }}"
             class="w-full max-h-[60vh] object-contain bg-gray-900">
    </div>

    <div class="mt-6 flex flex-wrap gap-3">
        {{-- Toggle Pin --}}
        <form action="{{ route('admin.activity-images.togglePin', $image) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit"
                class="{{ $image->is_pinned ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-gray-400 hover:bg-gray-500' }} text-white font-semibold py-2 px-4 rounded-md transition">
                {{ $image->is_pinned ? '📌 Unpin Image' : '📍 Pin Image' }}
            </button>
        </form>

        {{-- Delete --}}
        <form action="{{ route('admin.activity-images.destroy', $image) }}" method="POST"
              onsubmit="return confirm('Delete this image permanently?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md transition">
                Delete Image
            </button>
        </form>
    </div>
</div>
@endsection
