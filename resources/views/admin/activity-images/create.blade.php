@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <div class="mb-4">
        <a href="{{ route('admin.activity-images.index') }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back to Gallery
        </a>
    </div>

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Upload Activity Image</h2>

    @if($errors->any())
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-300 text-red-800 rounded-lg text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.activity-images.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                Title / Caption <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" id="title" required
                value="{{ old('title') }}"
                placeholder="e.g. MPLS 2024/2025"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Image Upload --}}
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                Image <span class="text-red-500">*</span>
                <span class="text-gray-400 font-normal">(JPEG, PNG, GIF, WebP — max 5MB)</span>
            </label>
            <input type="file" name="image" id="image" required accept="image/*"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                onchange="previewImage(event)">

            {{-- Preview --}}
            <div id="image-preview-wrapper" class="mt-3 hidden">
                <p class="text-xs text-gray-500 mb-1">Preview:</p>
                <img id="image-preview" src="#" alt="Preview"
                    class="max-h-48 rounded-lg border border-gray-200 shadow-sm object-contain">
            </div>
        </div>

        {{-- Pin Toggle --}}
        <label for="is_pinned" class="flex items-start gap-3 p-4 bg-yellow-50 border border-yellow-200 rounded-lg cursor-pointer hover:bg-yellow-100 transition">
            
            <input type="checkbox" name="is_pinned" id="is_pinned" value="1"
                {{ old('is_pinned') ? 'checked' : '' }}
                class="mt-0.5 w-4 h-4 accent-yellow-500 pointer-events-none">

            <div>
                <span class="text-sm font-medium text-gray-800">
                    📌 Pin this image
                </span>
                <p class="text-xs text-gray-500 mt-0.5">
                    Pinned images appear at the top of the activities page and the latest 4 pinned images appear on the homepage.
                </p>
            </div>

        </label>

        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-md shadow-md hover:bg-blue-700 transition font-semibold">
            Upload Image
        </button>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;
        const wrapper = document.getElementById('image-preview-wrapper');
        const preview = document.getElementById('image-preview');
        preview.src = URL.createObjectURL(file);
        wrapper.classList.remove('hidden');
    }
</script>
@endpush
@endsection
