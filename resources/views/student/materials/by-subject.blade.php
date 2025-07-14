@extends('layouts.student.dashboard')

@section('content')
<div class="w-full mx-auto p-6 bg-white rounded-2xl shadow-md space-y-6">

    {{-- Back Button --}}
    <div>
        <a href="{{ route('student.materials.index') }}"
            class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium shadow transition">
            ← Back to Subjects
        </a>
    </div>

    {{-- Subject Title --}}
    <h2 class="text-2xl font-bold text-gray-800">{{ $subject->name }} Materials</h2>

    {{-- Search + Clear --}}
    <form method="GET" class="flex flex-wrap gap-2 items-center mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search materials..."
            class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:border-blue-300">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
            Search
        </button>

        @if(request('search'))
            <a href="{{ route('student.materials.bySubject', $subject->id) }}"
               class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 transition">
                Clear Search
            </a>
        @endif
    </form>

    {{-- Sortable Header Helper --}}
    @php
        function sortLink($label, $column, $sort, $direction, $subjectId) {
            $newDirection = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';
            $arrow = $sort === $column ? ($direction === 'asc' ? '↑' : '↓') : '';
            $params = request()->all();
            $params['sort'] = $column;
            $params['direction'] = $newDirection;
            $url = route('student.materials.bySubject', $subjectId) . '?' . http_build_query($params);
            return '<a href="' . $url . '" class="hover:underline">' . $label . ' ' . $arrow . '</a>';
        }
    @endphp

    {{-- Table View --}}
    @if($materials->count())
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300 text-sm bg-white rounded-lg shadow-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">{!! sortLink('Material Name', 'name', $sort, $direction, $subject->id) !!}</th>
                        <th class="px-4 py-3 text-left">Description</th>
                        <th class="px-4 py-3 text-left">{!! sortLink('Created At', 'created_at', $sort, $direction, $subject->id) !!}</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 divide-y divide-gray-200">
                    @foreach($materials as $index => $material)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">
                                {{ ($materials->currentPage() - 1) * $materials->perPage() + $index + 1 }}
                            </td>
                            <td class="px-4 py-2 font-medium text-blue-700">{{ $material->name }}</td>
                            <td class="px-4 py-2 line-clamp-2">{{ $material->description }}</td>
                            <td class="px-4 py-2">{{ $material->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('student.materials.view', $material->id) }}"
                                   class="inline-block bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition text-sm shadow">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $materials->links() }}
        </div>
    @else
        <p class="text-gray-600">No materials found for this subject.</p>
    @endif
</div>
@endsection
