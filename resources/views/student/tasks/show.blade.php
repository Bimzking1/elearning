@extends('layouts.student.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <a href="{{ route('student.tasks.index') }}"
       class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-1.5 px-4 rounded-md text-sm shadow transition">
        ← Back
    </a>

    <div class="mb-6 mt-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Your Submission for Task:</h2>
        <p class="text-xl text-blue-600 font-semibold">{{ $submission->task->title }}</p>
    </div>

    {{-- Task Info --}}
    <div class="bg-gray-50 border rounded-lg p-6 mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Task Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 text-sm text-gray-700">
            {{-- Subject --}}
            <div class="flex items-start">
                <span class="w-28 font-medium text-gray-600">Subject:</span>
                <span class="text-gray-800">{{ $submission->task->subject->name ?? '-' }}</span>
            </div>

            {{-- Teacher Name --}}
            <div class="flex items-start">
                <span class="w-28 font-medium text-gray-600">Teacher:</span>
                <span class="text-gray-800">
                    {{ $submission->task->teacher && $submission->task->teacher->user ? $submission->task->teacher->user->name : '-' }}
                </span>
            </div>

            {{-- Email --}}
            <div class="flex items-start">
                <span class="w-28 font-medium text-gray-600">Assigner's Email:</span>
                <span class="text-gray-800">
                    {{ $submission->task->teacher && $submission->task->teacher->user ? $submission->task->teacher->user->email : '-' }}
                </span>
            </div>

            {{-- Phone --}}
            <div class="flex items-start">
                <span class="w-28 font-medium text-gray-600">Phone:</span>
                <span class="text-gray-800">
                    {{ $submission->task->teacher ? ($submission->task->teacher->phone ?? '-') : '-' }}
                </span>
            </div>
        </div>
    </div>

    {{-- Description --}}
    @if ($submission->task->description)
        <div class="bg-gray-50 border rounded-lg p-6 mb-6">
            <h3 class="text-sm font-semibold text-gray-700">Description:</h3>
            <p class="text-gray-600 text-sm">{{ $submission->task->description }}</p>
        </div>
    @endif

    {{-- Deadline --}}
    @if ($submission->task->deadline)
        @php
            $deadline = \Carbon\Carbon::parse($submission->task->deadline);
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
        <div class="mb-6 flex flex-col gap-2 bg-gray-50 border rounded-lg p-6">
            <h3 class="text-sm font-semibold text-gray-700">Deadline:</h3>
            <p class="{{ $deadlineTextClass }} text-sm flex flex-col md:flex-row justify-start items-start">
                {{ $deadline->format('F j, Y') }} - {{ $deadline->format('H:i') }}
                @if (!$isPast)
                    <span class="text-sm font-semibold md:ml-2">(
                        @if ($days >= 1)
                            {{ $days }} day{{ $days > 1 ? 's' : '' }}
                        @elseif ($hours >= 1)
                            {{ $hours }} hour{{ $hours > 1 ? 's' : '' }}
                        @endif

                        @if ($days < 1 && $minutes >= 1)
                            {{ $minutes }} minute{{ $minutes > 1 ? 's' : '' }}
                        @endif
                    )</span>
                @else
                    <span class="text-red-500 font-semibold mt-2 md:mt-0 md:ml-1">( Past Deadline )</span>
                @endif
            </p>
        </div>
    @endif

    {{-- Submission Text --}}
    <div class="grid gap-4 text-sm text-gray-700">
        <div class="bg-gray-50 p-4 rounded-md border">
            <h3 class="font-semibold text-gray-800 mb-1">Submission Text:</h3>
            <p class="text-gray-600 whitespace-pre-line">{{ $submission->submission_text }}</p>
        </div>

        @if($submission->submission_file)
            <div class="bg-gray-50 p-4 rounded-md border">
                <h3 class="font-semibold text-gray-800 mb-1">Attachment:</h3>
                <a href="{{ Storage::url($submission->submission_file) }}"
                   class="text-blue-500 hover:underline font-medium"
                   target="_blank" rel="noopener noreferrer">
                    Download Submission File
                </a>
            </div>
        @endif

        {{-- Score --}}
        <div class="bg-gray-50 p-4 rounded-md border">
            <h3 class="font-semibold text-gray-800 mb-1">Score:</h3>
            <p class="{{ $submission->score ? 'text-green-600 font-semibold' : 'text-gray-500 italic' }}">
                {{ $submission->score ?? 'Not graded yet' }}
            </p>
        </div>

        {{-- Edit Button --}}
        @if(!$submission->score)
            <div class="flex w-full justify-end items-end">
                <a href="{{ route('student.tasks.edit', $submission->task->id) }}"
                   class="inline-block mt-4 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-md shadow text-sm transition">
                    Edit Submission
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
