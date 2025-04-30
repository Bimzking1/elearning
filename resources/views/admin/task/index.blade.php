@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Manage Tasks</h2>
        <a href="{{ route('admin.tasks.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add Task
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full table-fixed bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="w-12 px-4 py-3 text-left">#</th>
                    <th class="w-1/4 px-4 py-3 text-left">Title</th>
                    <th class="w-1/5 px-4 py-3 text-left">Subject</th>
                    <th class="w-1/5 px-4 py-3 text-left">Classroom</th>
                    <th class="w-1/5 px-4 py-3 text-left">Due Date</th>
                    <th class="w-32 px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($tasks as $index => $task)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $task->title }}</td>
                        <td class="px-4 py-3">{{ $task->subject->name }}</td>
                        <td class="px-4 py-3">{{ $task->classroom->name }}</td>
                        <td class="px-4 py-3">
                            @if ($task->deadline)
                                {{ \Carbon\Carbon::parse($task->deadline)->format('F j, Y H:i') }}
                            @else
                                <span class="text-gray-400">N/A</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.tasks.edit', $task->id) }}"
                                   class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded-md shadow text-sm transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');" class="inline-block">
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
    </div>
</div>
@endsection
