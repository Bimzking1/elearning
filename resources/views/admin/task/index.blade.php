@extends('layouts.admin.dashboard')

@section('content')
@php
    function sortLink($column, $label, $currentSort, $currentDirection) {
        $newDirection = ($currentSort === $column && $currentDirection === 'asc') ? 'desc' : 'asc';
        $icon = ($currentSort === $column) ? ($currentDirection === 'asc' ? '▲' : '▼') : '';
        $query = request()->all();
        $query['sort'] = $column;
        $query['direction'] = $newDirection;
        $url = route('admin.tasks.index', $query);
        return "<a href='$url' class='hover:underline'>$label $icon</a>";
    }
@endphp

<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Manage Tasks</h2>
        <a href="{{ route('admin.tasks.create') }}"
           class="w-full md:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add Task
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.tasks.index') }}" class="mb-4 flex flex-wrap items-center gap-2 w-full max-w-md">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by title..."
            class="border px-4 py-2 rounded w-full sm:flex-1"
        >

        <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Search
        </button>

        @if(request('search'))
            <a href="{{ route('admin.tasks.index', array_merge(request()->except('search', 'page'))) }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded transition text-base">
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
                    <th class="w-1/4 px-4 py-3 text-left">{!! sortLink('title', 'Title', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-1/5 px-4 py-3 text-left">{!! sortLink('subject_name', 'Subject', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-1/5 px-4 py-3 text-left">{!! sortLink('classroom_name', 'Classroom', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-1/5 px-4 py-3 text-left">{!! sortLink('deadline', 'Due Date', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-32 px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($tasks as $index => $task)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            {{ $loop->iteration + ($tasks->currentPage() - 1) * $tasks->perPage() }}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900 max-w-[400px] truncate">{{ $task->title }}</td>
                        <td class="px-4 py-3">{{ $task->subject->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $task->classroom->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if ($task->deadline)
                                {{ \Carbon\Carbon::parse($task->deadline)->format('F j, Y H:i') }}
                            @else
                                <span class="text-gray-400">N/A</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.tasks.submissions.index', ['task' => $task->id]) }}"
                                    class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-1 px-2 rounded text-sm">
                                    Submissions
                                </a>
                                <a href="{{ route('admin.tasks.edit', $task->id) }}"
                                   class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded-md shadow text-sm transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this task?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded-md shadow text-sm transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center px-4 py-4 text-sm text-gray-500">No tasks available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection
