@extends('layouts.teacher.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <a href="{{ route('teacher.tasks.submissions.index', ['task' => $submission->task->id]) }}"
       class="bg-gray-300 text-gray-900 py-2 px-4 rounded-lg shadow-md transition">
        &larr; Back to Submissions
    </a>
    <div class="flex justify-between items-center mt-6">
        <h2 class="text-3xl font-bold text-gray-800">Grade Submission</h2>
    </div>

    <!-- Submission Details -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Student: {{ $submission->student->user->name }}</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div>
                <p><strong>Task:</strong> {{ $submission->task->title }}</p>
                <p class="mt-4"><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($submission->task->deadline)->format('Y-m-d H:i') }}</p>
                <p><strong>Submitted At:</strong> {{ $submission->created_at->format('Y-m-d H:i') }}</p>
                <p><strong>Time Difference:</strong>
                    @php
                        $deadline = \Carbon\Carbon::parse($submission->task->deadline);
                        $submittedAt = \Carbon\Carbon::parse($submission->created_at);

                        // Get the human-readable time difference
                        $difference = $submittedAt->diffForHumans($deadline, [
                            'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                            'parts' => 3, // Display up to 3 parts (days, hours, minutes)
                            'short' => true // Shorten the output (e.g., "2d" for 2 days)
                        ]);

                        // Determine if the submission is early or late
                        $status = $submittedAt->lessThan($deadline) ? 'Early' : 'Late';
                        // Choose class based on whether it's early or late
                        $statusClass = $submittedAt->lessThan($deadline) ? 'text-green-600 font-medium' : 'text-red-600 font-medium';
                    @endphp
                    <span class="{{ $statusClass }}">{{ $difference }} ({{ $status }})</span>
                </p>
            </div>
        </div>

        <!-- Display Submitted Text -->
        <div class="mb-6">
            <strong>Submitted Text:</strong>
            <p class="text-sm text-gray-600">{{ $submission->submission_text }}</p>
        </div>

        <!-- Display Submitted File (if available) -->
        @if($submission->submission_file)
        <div class="mb-6">
            <strong>Submitted File:</strong>
            <a href="{{ asset('storage/' . $submission->submission_file) }}" class="text-blue-600 hover:text-blue-700" download>
                Download Submission File
            </a>
        </div>
        @endif

        <!-- Score Form -->
        <form action="{{ route('teacher.tasks.submissions.update', ['task' => $submission->task->id, 'submission' => $submission->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-8">
                <label for="score" class="block text-lg font-medium text-gray-700 mb-2">Score</label>
                <input type="number" id="score" name="score" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-600 focus:border-indigo-600 sm:text-lg py-3 px-4" value="{{ old('score', $submission->score) }}" required min="0" max="100">
            </div>

            <div class="mb-8">
                <label for="comments" class="block text-lg font-medium text-gray-700 mb-2">Comments</label>
                <textarea id="comments" name="comments" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-600 focus:border-indigo-600 sm:text-lg py-3 px-4" rows="5">{{ old('comments', $submission->comments) }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg text-lg transition duration-300">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
