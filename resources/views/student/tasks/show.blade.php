@extends('layouts.student.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <a href="{{ route('student.tasks.index') }}"
       class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-1.5 px-4 rounded-md text-sm shadow transition">
        ← Back
    </a>
    <div class="mb-6 mt-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">
            Your Submission for Task:
        </h2>
        <p class="text-xl text-blue-600 font-semibold">{{ $submission->task->title }}</p>
    </div>

    <div class="grid gap-4 text-sm text-gray-700">
        <div class="bg-gray-50 p-4 rounded-md border">
            <h3 class="font-semibold text-gray-800 mb-1">Submission Text:</h3>
            <p class="text-gray-600">{{ $submission->submission_text }}</p>
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

        <div class="bg-gray-50 p-4 rounded-md border">
            <h3 class="font-semibold text-gray-800 mb-1">Score:</h3>
            <p class="{{ $submission->score ? 'text-green-600 font-semibold' : 'text-gray-500 italic' }}">
                {{ $submission->score ?? 'Not graded yet' }}
            </p>
        </div>

        <!-- Add the Edit Submission link here -->
        @if(!$submission->score)  <!-- Only show the edit link if the task hasn't been graded -->
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
