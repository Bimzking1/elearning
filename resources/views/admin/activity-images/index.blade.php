@extends('layouts.admin.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Activity Gallery</h2>
            <p class="text-sm text-gray-500 mt-1">Manage activity images shown on the homepage and activities page.</p>
        </div>
        <a href="{{ route('admin.activity-images.create') }}"
           class="w-full md:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Upload New Image
        </a>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search --}}
    <form method="GET" class="mb-4 flex flex-col md:flex-row gap-2 items-center max-w-md">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title"
            class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-300">
        <div class="flex gap-2">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">Search</button>
            @if(request('search'))
                <a href="{{ url()->current() }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 transition">Clear</a>
            @endif
        </div>
    </form>

    {{-- Legend --}}
    <div class="flex items-center gap-4 mb-4 text-sm text-gray-500">
        <span class="flex items-center gap-1">
            <span class="inline-block w-3 h-3 rounded-full bg-yellow-400"></span> Pinned (shown first on activities &amp; homepage)
        </span>
        <span class="flex items-center gap-1">
            <span class="inline-block w-3 h-3 rounded-full bg-gray-300"></span> Unpinned
        </span>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">#</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Preview</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Title / Caption</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Pin Order</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Uploaded</th>
                    <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($images as $image)
                    <tr class="{{ $image->is_pinned ? 'bg-yellow-50' : 'hover:bg-gray-50' }}">
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $image->id }}</td>
                        <td class="px-4 py-3">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                 alt="{{ $image->title }}"
                                 class="w-20 h-14 object-cover rounded-md shadow-sm">
                        </td>
                        <td class="px-4 py-3 text-sm font-medium text-gray-900 max-w-[220px] truncate">
                            {{ $image->title }}
                        </td>
                        <td class="px-4 py-3">
                            @if($image->is_pinned)
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                    📌 Pinned
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-600 rounded-full">
                                    Unpinned
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $image->is_pinned ? '#' . $image->pin_order : '—' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $image->created_at->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex justify-center flex-wrap gap-1">
                                {{-- View --}}
                                <a href="{{ route('admin.activity-images.show', $image) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold py-1 px-2 rounded-md transition">
                                    View
                                </a>
                                {{-- Edit --}}
                                <a href="{{ route('admin.activity-images.edit', $image) }}"
                                   class="bg-green-500 hover:bg-green-600 text-white text-xs font-semibold py-1 px-2 rounded-md transition">
                                    Edit
                                </a>
                                {{-- Toggle Pin --}}
                                <form action="{{ route('admin.activity-images.togglePin', $image) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="{{ $image->is_pinned ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-gray-400 hover:bg-gray-500' }} text-white text-xs font-semibold py-1 px-2 rounded-md transition"
                                        title="{{ $image->is_pinned ? 'Unpin image' : 'Pin image' }}">
                                        {{ $image->is_pinned ? '📌 Unpin' : '📍 Pin' }}
                                    </button>
                                </form>
                                {{-- Delete --}}
                                <form action="{{ route('admin.activity-images.destroy', $image) }}" method="POST"
                                      onsubmit="return confirm('Delete this image? This cannot be undone.')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white text-xs font-semibold py-1 px-2 rounded-md transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-400">
                            No images uploaded yet.
                            <a href="{{ route('admin.activity-images.create') }}" class="text-blue-600 underline ml-1">Upload the first one</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $images->links() }}
    </div>
</div>
@endsection
