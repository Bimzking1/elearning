@extends('layouts.admin.dashboard')

@section('content')
@php
    function sortLink($column, $label, $currentSort, $currentDirection) {
        $newDirection = ($currentSort === $column && $currentDirection === 'asc') ? 'desc' : 'asc';
        $icon = ($currentSort === $column) ? ($currentDirection === 'asc' ? '▲' : '▼') : '';
        $query = request()->all();
        $query['sort'] = $column;
        $query['direction'] = $newDirection;
        $query['view'] = request('view', 'table2'); // 👈 persist view mode
        $url = route('admin.schedules.index', $query);
        return "<a href='$url' class='hover:underline'>$label $icon</a>";
    }
@endphp

<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Manage Schedules</h2>
        <a href="{{ route('admin.schedules.create') }}"
           class="w-full md:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add Schedule
        </a>
    </div>

    {{-- 🔍 Search Filters --}}
    <form method="GET" action="{{ route('admin.schedules.index') }}" class="mb-6 flex flex-wrap gap-2" id="searchForm">
        <input type="hidden" name="view" id="viewMode" value="{{ request('view', 'table2') }}">
        <div id="classroomSearchContainer" class="w-full sm:w-auto">
            <input
                type="text"
                name="classroom"
                value="{{ request('classroom') }}"
                placeholder="Search classroom..."
                class="border px-4 py-2 rounded w-full"
            >
        </div>
        <input
            type="text"
            name="subject"
            value="{{ request('subject') }}"
            placeholder="Search subject..."
            class="border px-4 py-2 rounded w-full sm:w-auto"
        >
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        @if(request('classroom') || request('subject'))
            <a href="{{ route('admin.schedules.index', ['view' => request('view', 'table2')]) }}"
            class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                Clear
            </a>
        @endif
    </form>

    <div class="mb-4 flex space-x-2">
        <button onclick="toggleTableView('table2')" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow transition">Table View</button>
        <button onclick="toggleTableView('table1')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow transition">List View</button>
    </div>

    <!-- List View -->
    <div id="table1" class="table-view hidden overflow-x-auto">
        <table class="min-w-full table-fixed bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="w-12 px-4 py-3 text-left">#</th>
                    <th class="w-1/6 px-4 py-3 text-left">{!! sortLink('classroom_id', 'Classroom', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-1/6 px-4 py-3 text-left">{!! sortLink('subject_id', 'Subject', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-1/6 px-4 py-3 text-left">{!! sortLink('teacher_id', 'Teacher', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-1/6 px-4 py-3 text-left">{!! sortLink('day', 'Day', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-1/6 px-4 py-3 text-left">{!! sortLink('start_time', 'Time', $sort ?? '', $direction ?? '') !!}</th>
                    <th class="w-32 px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($schedules as $index => $schedule)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            {{ $view === 'table1'
                                ? ($index + 1 + ($schedules->currentPage() - 1) * $schedules->perPage())
                                : ($index + 1)
                            }}
                        </td>
                        <td class="px-4 py-3">{{ $schedule->classroom->name }}</td>
                        <td class="px-4 py-3">{{ $schedule->subject->name }}</td>
                        <td class="px-4 py-3">{{ $schedule->teacher->user->name }}</td>
                        <td class="px-4 py-3">{{ $schedule->day }}</td>
                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.schedules.edit', $schedule->id) }}"
                                   class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded-md shadow text-sm transition">Edit</a>
                                <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this schedule?');" class="inline-block">
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
                        <td colspan="7" class="text-center px-4 py-4 text-sm text-gray-500">No schedules available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($view === 'table1')
            <div class="mt-4">
                {{ $schedules->links() }}
            </div>
        @endif
    </div>

    <!-- Table View (unchanged) -->
    <div id="table2" class="table-view">
        @php
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            $timeSlots = ['19:00-20:00', '20:00-21:00', '21:00-21:30'];
        @endphp

        @foreach ($classrooms as $classroom)
            @php
                $showClass = !$classroomFilter || str_contains(strtolower($classroom->name), strtolower($classroomFilter));
            @endphp
            @if ($showClass)
                <div class="mb-10">
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Classroom: {{ $classroom->name }}</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-fixed bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm text-sm">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold tracking-wider">
                                <tr>
                                    <th class="w-32 px-4 py-3 text-left">Time</th>
                                    @foreach ($days as $day)
                                        <th class="w-1/5 px-4 py-3 text-left">{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($timeSlots as $time)
                                    @php [$start, $end] = explode('-', $time); @endphp
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 font-medium text-gray-700">{{ $time }}</td>
                                        @foreach ($days as $day)
                                            @php
                                                $matched = $classroom->schedules->first(function ($s) use ($day, $start, $classroom, $subjectFilter) {
                                                    $dayMatch = strtolower($s->day) === strtolower($day);
                                                    $timeMatch = substr($s->start_time, 0, 5) <= $start &&
                                                                substr($s->end_time, 0, 5) > $start;
                                                    $subjectMatch = !$subjectFilter || str_contains(strtolower($s->subject->name ?? ''), strtolower($subjectFilter));
                                                    return $s->classroom_id == $classroom->id && $dayMatch && $timeMatch && $subjectMatch;
                                                });
                                            @endphp
                                            <td class="px-4 py-3 text-gray-700">
                                                @if ($matched)
                                                    <a href="{{ route('admin.schedules.edit', $matched->id) }}" class="block text-black rounded-md px-2 py-1 hover:bg-gray-200 transition cursor-pointer">
                                                        <strong>{{ $matched->subject->name }}</strong><br>
                                                        <span class="text-xs">{{ $matched->teacher->user->name }}</span>
                                                    </a>
                                                @else
                                                    <span class="text-gray-400 text-sm">-</span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

<script>
    function toggleTableView(tableId) {
        document.querySelector('input[name="classroom"]').value = '';
        document.querySelector('input[name="subject"]').value = '';
        document.getElementById('viewMode').value = tableId;
        document.getElementById('searchForm').submit();
    }

    window.addEventListener('DOMContentLoaded', function () {
        const view = "{{ request('view', 'table2') }}";
        document.querySelectorAll('.table-view').forEach(table => table.classList.add('hidden'));
        document.getElementById(view).classList.remove('hidden');
    });
</script>

@endsection
