@extends('layouts.admin.dashboard')

@section('content')
@php
    function sortLink($column, $label, $currentSort, $currentDirection) {
        $newDirection = ($currentSort === $column && $currentDirection === 'asc') ? 'desc' : 'asc';
        $icon = ($currentSort === $column) ? ($currentDirection === 'asc' ? '▲' : '▼') : '';
        $query = request()->all();
        $query['sort'] = $column;
        $query['direction'] = $newDirection;
        $url = route('admin.subjects.index', $query);
        return "<a href='$url' class='hover:underline'>$label $icon</a>";
    }
@endphp

<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Subjects</h2>
        <a href="{{ route('admin.subjects.create') }}"
            class="w-full md:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add New Subject
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.subjects.index') }}" class="mb-4 flex flex-wrap items-center gap-2 w-full max-w-md">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by subject name..."
            class="border px-4 py-2 rounded w-full sm:flex-1"
        >

        <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Search
        </button>

        @if(request('search'))
            <a href="{{ route('admin.subjects.index', array_merge(request()->except('search', 'page'))) }}"
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
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">{!! sortLink('name', 'Name', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">{!! sortLink('description', 'Description', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($subjects as $index => $subject)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration + ($subjects->currentPage() - 1) * $subjects->perPage() }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $subject->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $subject->description }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.subjects.edit', $subject) }}"
                                   class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded-md text-sm shadow-md transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this subject?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded-md text-sm shadow-md transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            No subjects found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $subjects->links() }}
        </div>
    </div>
</div>
@endsection
