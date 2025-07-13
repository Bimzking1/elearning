@extends('layouts.teacher.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('teacher.presence.show', ['classroom' => $classroom->id, 'schedule' => $schedule->id]) }}"
           class="inline-flex items-center text-sm text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg font-medium transition">
            ← Back
        </a>
    </div>

    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-1">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ $schedule->subject->name }} - {{ $classroom->name }}
        </h2>

        <p class="text-gray-700 text-sm">
            <span class="font-medium">Time:</span>
            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
        </p>

        <p class="text-gray-700 text-sm">
            <span class="font-medium">Opened At:</span>
            {{ $presence->opened_at->format('D, M j Y, H:i') }}
        </p>

        @if ($presence->reopened_at)
            <p class="text-gray-700 text-sm">
                <span class="font-medium">Reopened At:</span>
                {{ $presence->reopened_at->format('D, M j Y, H:i') }}
            </p>
        @endif

        @if ($presence->closed_at)
            <p class="text-gray-700 text-sm">
                <span class="font-medium">Closed At:</span>
                {{ $presence->closed_at->format('D, M j Y, H:i') }}
            </p>
        @endif
    </div>

    {{-- Submission Table --}}
    @if ($submissions->isEmpty())
        <div class="text-center text-gray-500 py-6">No students have submitted presence yet.</div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] table-auto bg-white border border-gray-300 text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Student Name</th>
                        <th class="px-4 py-3 text-left">NIS</th>
                        <th class="px-4 py-3 text-left">Attended At</th>
                        <th class="px-4 py-3 text-left">Photo</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach ($submissions as $index => $submission)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $submission->student->user->name }}</td>
                            <td class="px-4 py-2">{{ $submission->student->nis }}</td>
                            <td class="px-4 py-2">{{ $submission->created_at->format('D, M j Y, H:i') }}</td>
                            <td class="px-4 py-2">
                                @if ($submission->photo_path)
                                    <button onclick="openPhotoModal('{{ asset('storage/' . $submission->photo_path) }}')"
                                            class="text-blue-600 hover:underline">
                                        View Photo
                                    </button>
                                @else
                                    <span class="text-gray-500 italic">No Photo</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- Modal --}}
<div id="photoModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-70"
     onclick="closePhotoModal(event)">
    <div class="relative max-w-4xl w-full px-4" onclick="event.stopPropagation()">
        <img id="modalImage"
            src=""
            alt="Zoomed Photo"
            class="mx-auto w-full max-w-3xl max-h-[80vh] bg-white object-contain rounded-lg shadow-lg border-4 border-white">

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
        const image = document.getElementById('modalImage');
        image.src = src;
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
        if (event.key === 'Escape') {
            closePhotoModal();
        }
    });
</script>
@endpush
