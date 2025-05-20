@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.tasks.index') }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <div class="mb-6 mt-4">
        <h2 class="text-3xl font-bold text-gray-800">Task Submissions</h2>
    </div>

    <!-- Table for Submissions -->
    <div class="overflow-x-auto">
        <table class="min-w-full table-fixed bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="w-1/4 px-4 py-3 text-left">Student</th>
                    <th class="w-1/4 px-4 py-3 text-left">Task</th>
                    <th class="w-1/5 px-4 py-3 text-left">Submitted At</th>
                    <th class="w-1/5 px-4 py-3 text-left">Score</th>
                    <th class="w-32 px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($submissions as $submission) <!-- This should work as the $submissions variable is passed correctly -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $submission->student->user->name }}</td>
                        <td class="px-4 py-3">{{ $submission->task->title }}</td>
                        <td class="px-4 py-3">{{ $submission->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3">
                            @if ($submission->score !== null)
                                <span class="font-medium
                                    @if ($submission->score >= 80)
                                        text-green-600
                                    @elseif ($submission->score >= 70)
                                        text-yellow-600
                                    @else
                                        text-gray-600
                                    @endif
                                ">
                                    {{ $submission->score }}
                                </span>
                            @else
                                <span class="text-gray-400">Not Graded</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.tasks.submissions.edit', ['task' => $submission->task->id, 'submission' => $submission->id]) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded-md shadow text-sm transition">
                                Grade
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center px-4 py-4 text-sm text-gray-500">No submissions available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
