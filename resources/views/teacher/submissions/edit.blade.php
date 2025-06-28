@extends('layouts.teacher.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow-md space-y-8">

    {{-- Back Button --}}
    <a href="{{ route('teacher.tasks.submissions.index', ['task' => $submission->task->id]) }}"
       class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow-sm transition">
        ← Back to Submissions
    </a>

    {{-- Page Header --}}
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold text-gray-900">Grade Submission</h2>
    </div>

    {{-- Student Information --}}
    <div class="bg-gray-50 border rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Student Information</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm text-gray-700">
            <div class="flex items-center">
                <span class="w-28 font-medium text-gray-600">Name:</span>
                <span>{{ $submission->student->user->name ?? '-' }}</span>
            </div>

            <div class="flex items-center">
                <span class="w-28 font-medium text-gray-600">Email:</span>
                <span>{{ $submission->student->user->email ?? '-' }}</span>
            </div>

            <div class="flex items-center">
                <span class="w-28 font-medium text-gray-600">Phone:</span>
                <span>{{ $submission->student->phone ?? '-' }}</span>
            </div>

            <div class="flex items-center">
                <span class="w-28 font-medium text-gray-600">Class:</span>
                <span>{{ $submission->student->classroom->name ?? '-' }}</span>
            </div>
        </div>
    </div>

    {{-- Task Info --}}
    <div class="bg-gray-50 border rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Task Details</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm text-gray-700">
            <div class="flex flex-col">
                <span class="font-medium text-gray-600">Task:</span>
                <span>{{ $submission->task->title }}</span>
            </div>

            <div class="flex flex-col">
                <span class="font-medium text-gray-600">Deadline:</span>
                <span>{{ \Carbon\Carbon::parse($submission->task->deadline)->format('Y-m-d H:i') }}</span>
            </div>

            <div class="flex flex-col">
                <span class="font-medium text-gray-600">Submitted At:</span>
                <span>{{ $submission->created_at->format('Y-m-d H:i') }}</span>
            </div>

            <div class="flex flex-col">
                <span class="font-medium text-gray-600">Time Difference:</span>
                @php
                    $deadline = \Carbon\Carbon::parse($submission->task->deadline);
                    $submittedAt = \Carbon\Carbon::parse($submission->created_at);
                    $difference = $submittedAt->diffForHumans($deadline, [
                        'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                        'parts' => 3,
                        'short' => true
                    ]);
                    $status = $submittedAt->lessThan($deadline) ? 'Early' : 'Late';
                    $statusClass = $submittedAt->lessThan($deadline) ? 'text-green-600' : 'text-red-600';
                @endphp
                <span class="font-medium {{ $statusClass }}">{{ $difference }} ({{ $status }})</span>
            </div>
        </div>
    </div>

    {{-- Submitted Content --}}
    <div class="bg-gray-50 border rounded-lg p-6 space-y-4">
        <div>
            <h4 class="text-md font-semibold text-gray-700">Submitted Text:</h4>
            <p class="text-sm text-gray-600 whitespace-pre-line">{{ $submission->submission_text }}</p>
        </div>

        @if($submission->submission_file)
            <div>
                <h4 class="text-md font-semibold text-gray-700">Submitted File:</h4>
                <a href="{{ asset('storage/' . $submission->submission_file) }}"
                   class="text-blue-600 hover:underline text-sm font-medium"
                   download>
                    Download Submission File
                </a>
            </div>
        @endif
    </div>

    {{-- Score Form --}}
    <form action="{{ route('teacher.tasks.submissions.update', ['task' => $submission->task->id, 'submission' => $submission->id]) }}"
          method="POST"
          class="bg-gray-50 border rounded-lg p-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="score" class="block text-lg font-medium text-gray-700 mb-1">Score</label>
            <input type="number" id="score" name="score"
                   class="w-full border-gray-300 rounded-md shadow-sm px-4 py-3 focus:ring-blue-500 focus:border-blue-500 sm:text-lg"
                   value="{{ old('score', $submission->score) }}" required min="0" max="100">
        </div>

        <div>
            <label for="comments" class="block text-lg font-medium text-gray-700 mb-1">Comments</label>
            <textarea id="comments" name="comments"
                      class="w-full border-gray-300 rounded-md shadow-sm px-4 py-3 focus:ring-blue-500 focus:border-blue-500 sm:text-lg"
                      rows="5">{{ old('comments', $submission->comments) }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-md shadow-md text-lg transition">
                Save Grade
            </button>
        </div>
    </form>
</div>
@endsection
