@extends('layouts.admin.dashboard')

@section('content')
@php
    function sortLink($column, $label, $currentSort, $currentDirection) {
        $newDirection = ($currentSort === $column && $currentDirection === 'asc') ? 'desc' : 'asc';
        $arrow = ($currentSort === $column) ? ($currentDirection === 'asc' ? '↑' : '↓') : '';
        $query = request()->all();
        $query['sort'] = $column;
        $query['direction'] = $newDirection;
        $url = route('admin.tasks.submissions.index', request()->route('task')) . '?' . http_build_query($query);
        return "<a href=\"$url\" class=\"hover:underline\">$label $arrow</a>";
    }
@endphp

<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    {{-- Back Button --}}
    <div>
        <a href="{{ route('admin.tasks.index') }}"
           class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>

    {{-- Title --}}
    <div class="mb-6 mt-4">
        <h2 class="text-3xl font-bold text-gray-800">Task Submissions</h2>
    </div>

    {{-- Search --}}
    <form method="GET" class="mb-4 flex flex-wrap gap-2 items-center">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Search by student name..."
               class="px-4 py-2 border rounded w-full sm:w-auto">

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Search
        </button>

        @if(request('search'))
            <a href="{{ route('admin.tasks.submissions.index', request()->route('task')) }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded transition">
                Clear
            </a>
        @endif
    </form>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full table-fixed bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="w-12 px-4 py-3 text-left">#</th>
                    <th class="w-1/4 px-4 py-3 text-left">{!! sortLink('student_name', 'Student', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-1/4 px-4 py-3 text-left">{!! sortLink('task_title', 'Task', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-1/5 px-4 py-3 text-left">{!! sortLink('created_at', 'Submitted At', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-1/5 px-4 py-3 text-left">{!! sortLink('score', 'Score', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-32 px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($submissions as $index => $submission)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-800 font-semibold">
                            {{ ($submissions->currentPage() - 1) * $submissions->perPage() + $index + 1 }}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">
                            {{ $submission->student->user->name }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $submission->task->title }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $submission->created_at->format('Y-m-d H:i') }}
                        </td>
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
                        <td colspan="6" class="text-center px-4 py-4 text-sm text-gray-500">
                            No submissions available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $submissions->links() }}
    </div>
</div>
@endsection
