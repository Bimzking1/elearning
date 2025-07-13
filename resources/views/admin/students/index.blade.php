@extends('layouts.admin.dashboard')

@section('content')
@php
    function sortLink($column, $label, $currentSort, $currentDirection) {
        $newDirection = ($currentSort === $column && $currentDirection === 'asc') ? 'desc' : 'asc';
        $icon = ($currentSort === $column) ? ($currentDirection === 'asc' ? '▲' : '▼') : '';
        $query = request()->all();
        $query['sort'] = $column;
        $query['direction'] = $newDirection;
        $url = route('admin.students.index', $query);
        return "<a href='$url' class='hover:underline'>$label $icon</a>";
    }
@endphp

<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Manage Students</h2>
        <a href="{{ route('admin.students.create') }}" class="w-full md:w-auto text-center inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 4v16m8-8H4" />
            </svg>
            Add New Student
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.students.index') }}" class="mb-4 flex flex-wrap items-center gap-2 w-full max-w-md">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by name..."
            class="border px-4 py-2 rounded w-full sm:flex-1"
        >

        <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Search
        </button>

        @if(request('search'))
            <a href="{{ route('admin.students.index', array_merge(request()->except('search', 'page'))) }}"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded transition text-base">
                Clear Search
            </a>
        @endif
    </form>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">{!! sortLink('name', 'Name', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">{!! sortLink('classroom', 'Classroom', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">{!! sortLink('phone', 'Phone', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($students as $index => $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $student->user->name }}</td>
                        <td class="px-6 py-4">{{ $student->classroom->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $student->phone }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.students.edit', $student->id) }}"
                                   class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded-md text-sm shadow-md">Edit</a>
                                <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this student?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md text-sm shadow-md">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $students->links() }}
        </div>
    </div>
</div>
@endsection
