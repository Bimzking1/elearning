@extends('layouts.student.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <a href="{{ route('student.tasks.show', $task->id) }}"
       class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-1.5 px-4 rounded-md text-sm shadow transition">
        ← Back to Submission
    </a>

    <div class="mt-6">
        <h2 class="text-lg font-medium text-gray-800 mb-2">Edit Submission:</h2>
    </div>

    <div class="mb-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $task->title }}</h2>

        {{-- Description --}}
        @if ($task->description)
            <div class="mb-4">
                <h3 class="text-sm font-semibold text-gray-700">Description:</h3>
                <p class="text-gray-600 text-sm">{{ $task->description }}</p>
            </div>
        @endif

        {{-- Deadline --}}
        @if ($task->deadline)
            @php
                $deadline = \Carbon\Carbon::parse($task->deadline);
                $now = now();

                $diffInMinutes = $now->diffInMinutes($deadline, false);
                $isPast = $diffInMinutes < 0;
                $absMinutes = abs($diffInMinutes);

                $days = floor($absMinutes / 1440);
                $hours = floor(($absMinutes % 1440) / 60);
                $minutes = $absMinutes % 60;

                $isLessThanOneHour = !$isPast && $absMinutes < 60;
                $deadlineTextClass = $isLessThanOneHour ? 'text-red-600' : 'text-gray-600';
            @endphp
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-700">Deadline:</h3>
                <p class="{{ $deadlineTextClass }} text-sm flex flex-col">
                    {{ $deadline->format('F j, Y') }} - {{ $deadline->format('H:i') }}

                    @if (!$isPast)
                        <span class="text-sm font-semibold">
                            @if ($days >= 1)
                                {{ $days }} day{{ $days > 1 ? 's' : '' }}
                            @elseif ($hours >= 1)
                                {{ $hours }} hour{{ $hours > 1 ? 's' : '' }}
                            @endif

                            @if ($days < 1 && $minutes >= 1)
                                {{ $minutes }} minute{{ $minutes > 1 ? 's' : '' }}
                            @endif
                        </span>

                    @else
                        <span class="text-red-500 font-semibold">Past Deadline</span>
                    @endif
                </p>
            </div>
        @endif
    </div>

    <form action="{{ route('student.tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label for="submission_text" class="block text-sm font-medium text-gray-700 mb-1">
                Submission Text
            </label>
            <textarea name="submission_text" id="submission_text" rows="5"
                      class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none">{{ old('submission_text', $submission->submission_text) }}</textarea>
            @error('submission_text')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="submission_file" class="block text-sm font-medium text-gray-700 mb-1">
                Replace File (optional)
            </label>
            <input type="file" name="submission_file" id="submission_file"
                   class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
            @if ($submission->submission_file)
                <p class="text-sm font-medium text-gray-500 mt-1">Current file:
                    <a href="{{ Storage::url($submission->submission_file) }}" target="_blank" class="text-blue-500 hover:underline">View Current File</a>
                </p>
            @endif
            @error('submission_file')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-2 rounded-md shadow transition text-sm">
                Update Submission
            </button>
        </div>
    </form>
</div>
@endsection
