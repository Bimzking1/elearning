@extends('layouts.student.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Your Tasks</h2>
    </div>

    {{-- Search and clear --}}
    <form method="GET" class="mb-4 flex gap-2 flex-wrap">
        <input type="text" name="task" value="{{ request('task') }}" placeholder="Search by task title"
            class="w-full md:w-64 border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring focus:border-blue-300">

        <input type="text" name="subject" value="{{ request('subject') }}" placeholder="Search by subject"
            class="w-full md:w-64 border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring focus:border-blue-300">

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
            Search
        </button>

        @if(request('task') || request('subject'))
            <a href="{{ route('student.tasks.index') }}"
            class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 transition">
                Clear Search
            </a>
        @endif
    </form>

    {{-- Sorting helper --}}
    @php
        function sortLink($label, $column, $sort, $direction) {
            $newDirection = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';
            $arrow = $sort === $column ? ($direction === 'asc' ? '↑' : '↓') : '';
            $query = request()->all();
            $query['sort'] = $column;
            $query['direction'] = $newDirection;
            $url = route('student.tasks.index', $query);
            return '<a href="' . $url . '" class="hover:underline">' . $label . ' ' . $arrow . '</a>';
        }
    @endphp

    <div class="overflow-x-auto">
        <table class="min-w-full table-fixed bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="w-12 px-4 py-3 text-left">#</th>
                    <th class="w-1/4 px-4 py-3 text-left">{!! sortLink('Task Title', 'title', $sort, $direction) !!}</th>
                    <th class="w-1/4 px-4 py-3 text-left">Subject</th>
                    <th class="w-1/4 px-4 py-3 text-left">{!! sortLink('Deadline', 'deadline', $sort, $direction) !!}</th>
                    <th class="w-1/4 px-4 py-3 text-left">Status</th>
                    <th class="w-1/4 px-4 py-3 text-left">Score</th>
                    <th class="w-1/4 px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($tasks as $index => $task)
                    @php
                        $submission = $task->submissions->first();
                        $isLate = $submission && $task->deadline && $submission->created_at > $task->deadline;
                        $deadline = $task->deadline ? \Carbon\Carbon::parse($task->deadline) : null;
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            {{ ($tasks->currentPage() - 1) * $tasks->perPage() + $index + 1 }}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $task->title }}</td>
                        <td class="px-4 py-3 text-gray-800">
                            {{ $task->subject->name ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if ($deadline)
                                @php
                                    $now = now();
                                    $diff = $now->diffInMinutes($deadline, false);
                                    $isPast = $diff < 0;
                                    $abs = abs($diff);
                                    $days = floor($abs / 1440);
                                    $hours = floor(($abs % 1440) / 60);
                                    $minutes = $abs % 60;
                                    $class = (!$isPast && $abs < 60) ? 'text-red-600' : 'text-gray-600';
                                @endphp
                                <p class="{{ $class }}">
                                    {{ $deadline->format('F j, Y - H:i') }}<br>
                                    @if (!$isPast)
                                        <span class="font-semibold text-xs">
                                            @if ($days >= 1) {{ $days }}d @endif
                                            @if ($hours >= 1) {{ $hours }}h @endif
                                            @if ($minutes >= 1) {{ $minutes }}m @endif
                                        </span>
                                    @else
                                        <span class="text-red-500 font-semibold text-xs">Past Deadline</span>
                                    @endif
                                </p>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if ($submission)
                                <span class="text-green-600">Submitted</span>
                                @if ($isLate)
                                    <span class="text-red-600 font-semibold">(Late)</span>
                                @endif
                            @else
                                <span class="text-yellow-600">Not Submitted</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if ($submission && $submission->score !== null)
                                <span class="font-medium
                                    @if ($submission->score > 80) text-green-600
                                    @elseif ($submission->score >= 70) text-yellow-600
                                    @else text-gray-600
                                    @endif">
                                    {{ $submission->score }}
                                </span>
                            @else
                                <span class="text-gray-500">Not Graded</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center space-y-2">
                            @if (!$submission)
                                <a href="{{ route('student.tasks.submit', $task->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded-md shadow text-sm transition">
                                    Submit
                                </a>
                            @else
                                <a href="{{ route('student.tasks.show', $task->id) }}"
                                   class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded-md shadow text-sm transition">
                                    View
                                </a>
                                @if ($submission->score === null)
                                    <a href="{{ route('student.tasks.edit', $task->id) }}"
                                       class="block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1 px-3 rounded-md shadow text-sm transition">
                                        Edit
                                    </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $tasks->links() }}
    </div>
</div>
@endsection
