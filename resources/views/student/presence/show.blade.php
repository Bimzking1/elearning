@extends('layouts.student.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 sm:p-8 rounded-2xl shadow-md">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('student.presence.schedule.history', $presence->schedule_id) }}"
        class="inline-flex items-center text-sm text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg font-medium transition">
            ← Back
        </a>
    </div>

    {{-- Page Title --}}
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">
        Submit Your Presence
    </h1>

    {{-- Presence Session Name --}}
    <p class="text-lg text-blue-700 font-semibold mb-6">
        {{ $presence->name }}
    </p>

    {{-- Session Info --}}
    <div class="grid gap-2 text-sm text-gray-700 mb-6">
        <div><span class="font-medium">Subject:</span> {{ $presence->schedule->subject->name }}</div>
        <div><span class="font-medium">Class:</span> {{ $presence->schedule->classroom->name }}</div>
        <div>
            <span class="font-medium">Time:</span>
            {{ \Carbon\Carbon::parse($presence->schedule->start_time)->format('H:i') }} -
            {{ \Carbon\Carbon::parse($presence->schedule->end_time)->format('H:i') }}
        </div>
        <div><span class="font-medium">Opened At:</span> {{ $presence->opened_at->format('D, M j Y, H:i') }}</div>

        @if ($presence->closed_at)
            <div><span class="font-medium">Closed At:</span> {{ $presence->closed_at->format('D, M j Y, H:i') }}</div>
        @else
            <div>
                <span class="font-medium">Status:</span>
                <span class="text-green-600 font-semibold">Open</span>
            </div>
        @endif
    </div>

    {{-- If already submitted --}}
    @if($submitted)
        <div class="bg-green-100 border border-green-300 text-green-800 px-5 py-3 rounded-lg mb-6">
            ✅ You have already submitted your presence.
        </div>

        <div class="mt-4">
            <p class="font-medium text-gray-700 mb-2">Your submitted photo:</p>
            <img src="{{ assetSubmissionPhoto($submitted->photo_path) }}"
                 alt="Selfie submission"
                 class="w-48 h-auto rounded-md border border-gray-300 shadow-sm cursor-pointer hover:opacity-90 transition"
                 onclick="openPhotoModal('{{ assetSubmissionPhoto($submitted->photo_path) }}')">

            <p class="text-sm text-gray-600 mt-2">
                Submitted at: {{ \Carbon\Carbon::parse($submitted->created_at)->format('D, M j Y, H:i') }}
            </p>
        </div>

    {{-- If closed --}}
    @elseif($presence->closed_at)
        <div class="bg-red-100 border border-red-300 text-red-800 px-5 py-3 rounded-lg">
            ❌ This session is closed. You can no longer submit your presence.
        </div>

    {{-- Submission form --}}
    @else
        <form action="{{ route('student.presence.submit', $presence->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6 mt-4">
            @csrf

            <div>
                <label for="photo" class="block text-sm font-semibold text-gray-700 mb-2">
                    Upload Your Selfie
                </label>
                <input
                    type="file"
                    name="photo"
                    id="photo"
                    accept="image/*"
                    required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
                @error('photo')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                    Submit Presence
                </button>
            </div>
        </form>
    @endif
</div>

{{-- Zoom Photo Modal --}}
<div id="photoModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-70"
     onclick="closePhotoModal(event)">
    <div class="relative max-w-4xl w-full px-4" onclick="event.stopPropagation()">
        <img id="modalImage"
             src=""
             alt="Zoomed Photo"
             class="mx-auto max-h-[90vh] rounded-lg shadow-lg border-4 border-white">

        <button onclick="closePhotoModal(event)"
                class="absolute top-4 right-4 text-white text-2xl font-bold hover:text-red-400 transition">
            &times;
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openPhotoModal(src) {
        const modal = document.getElementById('photoModal');
        document.getElementById('modalImage').src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closePhotoModal(event) {
        const modal = document.getElementById('photoModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.getElementById('modalImage').src = '';
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape") {
            closePhotoModal();
        }
    });
</script>
@endpush
