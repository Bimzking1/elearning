@extends('layouts.student.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Your Tasks</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full table-fixed bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="w-1/4 px-4 py-3 text-left">Task Title</th>
                    <th class="w-1/4 px-4 py-3 text-left">Deadline</th>
                    <th class="w-1/4 px-4 py-3 text-left">Status</th>
                    <th class="w-1/4 px-4 py-3 text-left">Score</th> <!-- New Column for Score -->
                    <th class="w-1/4 px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($tasks as $task)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $task->title }}</td>
                        <td class="px-4 py-3">
                            @if ($task->deadline)
                            @php
                            $deadline = \Carbon\Carbon::parse($task->deadline);
                            $now = now();

                            $diffInMinutes = $now->diffInMinutes($deadline, false);

                            $isPast = $diffInMinutes < 0;
                            $absMinutes = abs($diffInMinutes);

                            $days = floor($absMinutes / 1440); // 1440 minutes in a day
                            $hours = floor(($absMinutes % 1440) / 60);
                            $minutes = $absMinutes % 60;

                            $isLessThanOneHour = !$isPast && $absMinutes < 60;
                            $deadlineTextClass = $isLessThanOneHour ? 'text-red-600' : 'text-gray-600';
                        @endphp

                                <div>
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
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $submission = $task->submissions->where('student_id', Auth::user()->student->id)->first();
                            @endphp

                            @if ($submission)
                                @php
                                    $isLate = $submission->created_at && $submission->created_at > $task->deadline;
                                @endphp

                                <span class="text-green-600">Submitted</span>
                                @if ($isLate)
                                    <span class="text-red-600 font-semibold">(Submitted Late)</span>
                                @endif
                            @else
                                <span class="text-yellow-600">Not Submitted</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if ($task->submissions->where('student_id', Auth::user()->student->id)->isEmpty())
                                <span class="text-gray-400">-</span> <!-- No submission -->
                            @else
                                @php
                                    $submission = $task->submissions->where('student_id', Auth::user()->student->id)->first();
                                    $score = $submission->score;
                                @endphp
                                @if ($score !== null)
                                    <span class="font-medium
                                        @if ($score > 80)
                                            text-green-600
                                        @elseif ($score >= 70 && $score <= 80)
                                            text-yellow-600
                                        @else
                                            text-gray-600
                                        @endif
                                    ">
                                        {{ $score }}
                                    </span> <!-- Show score with dynamic color -->
                                @else
                                    <span class="text-gray-500">Not Graded Yet</span> <!-- If score is null -->
                                @endif
                            @endif
                        </td>
                        <td class="w-full px-4 py-3 text-center">
                            @if ($task->submissions->where('student_id', Auth::user()->student->id)->isEmpty())
                                <a href="{{ route('student.tasks.submit', $task->id) }}" class="w-full inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded-md shadow text-sm transition">
                                    Submit
                                </a>
                            @else
                                <a href="{{ route('student.tasks.show', $task->id) }}" class="w-full inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded-md shadow text-sm transition">
                                    View Submission
                                </a>

                                <!-- Add Edit Submission Button -->
                                @if ($task->submissions->where('student_id', Auth::user()->student->id)->first()->score === null)
                                <!-- Only show the edit button if not graded -->
                                <a href="{{ route('student.tasks.edit', $task->id) }}" class="w-full inline-block mt-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1 px-3 rounded-md shadow text-sm transition">
                                    Edit Submission
                                </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
