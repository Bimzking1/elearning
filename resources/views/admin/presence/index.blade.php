@extends('layouts.admin.dashboard')

@section('content')
@php
    function sortLink($column, $label, $currentSort, $currentDirection) {
        $newDirection = ($currentSort === $column && $currentDirection === 'asc') ? 'desc' : 'asc';
        $icon = ($currentSort === $column) ? ($currentDirection === 'asc' ? '▲' : '▼') : '';
        $query = request()->all();
        $query['sort'] = $column;
        $query['direction'] = $newDirection;
        $url = route('admin.presence.index', $query);
        return "<a href=\"$url\" class=\"hover:underline\">$label $icon</a>";
    }
@endphp

<div class="w-full bg-white p-6 rounded-lg shadow-md">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Presence Schedule</h2>
        <div class="flex gap-2">
            <a href="{{ route('admin.presence.index', ['view' => 'list']) }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
            List View
            </a>
            <a href="{{ route('admin.presence.index', ['view' => 'table']) }}"
               class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition">
               Table View
            </a>
        </div>
    </div>

    {{-- 🔍 Search Form --}}
    <form method="GET" action="{{ route('admin.presence.index') }}" class="mb-6 flex flex-wrap gap-2">
        <input type="hidden" name="view" value="{{ $view }}">
        <input type="text" name="classroom" value="{{ request('classroom') }}" placeholder="Search classroom..." class="border px-4 py-2 rounded">
        <input type="text" name="subject" value="{{ request('subject') }}" placeholder="Search subject..." class="border px-4 py-2 rounded">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        @if(request('subject') || request('classroom'))
            <a href="{{ route('admin.presence.index', ['view' => $view]) }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Clear Search</a>
        @endif
    </form>

    {{-- 📋 LIST VIEW --}}
    @if($view === 'list')
    <div class="overflow-x-auto">
        <table class="min-w-full table-fixed bg-white border border-gray-300 rounded text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold">
                <tr>
                    <th class="w-10 px-4 py-3 text-left">#</th>
                    <th class="w-1/6 px-4 py-3 text-left">{!! sortLink('classroom', 'Classroom', $sort, $direction) !!}</th>
                    <th class="w-1/6 px-4 py-3 text-left">{!! sortLink('subject', 'Subject', $sort, $direction) !!}</th>
                    <th class="w-1/6 px-4 py-3 text-left">{!! sortLink('teacher', 'Teacher', $sort, $direction) !!}</th>
                    <th class="w-1/6 px-4 py-3 text-left">{!! sortLink('day', 'Day', $sort, $direction) !!}</th>
                    <th class="w-1/6 px-4 py-3 text-left">{!! sortLink('start_time', 'Time', $sort, $direction) !!}</th>
                    <th class="w-1/6 px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($schedules as $index => $schedule)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $schedule->id }}</td>
                        <td class="px-4 py-3">{{ $schedule->classroom->name }}</td>
                        <td class="px-4 py-3">{{ $schedule->subject->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $schedule->teacher->user->name ?? '-' }}</td>
                        <td class="px-4 py-3 capitalize">{{ $schedule->day }}</td>
                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.presence.show', [$schedule->classroom_id, $schedule->id]) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded text-sm">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-4 py-4 text-center text-gray-500">No schedules found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif

    {{-- 🧱 TABLE VIEW --}}
    @if($view === 'table')
        @php
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            $timeSlots = ['19:00-20:00', '20:00-21:00', '21:00-21:30'];
        @endphp

        @foreach ($groupedSchedules as $group)
            @if($group['schedules']->isNotEmpty())
                <div class="mb-10">
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Classroom: {{ $group['classroom']->name }}</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-fixed bg-white border border-gray-300 rounded text-sm">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold">
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
                                        <td class="px-4 py-3 font-medium">{{ $time }}</td>
                                        @foreach ($days as $day)
                                            @php
                                                $matched = $group['schedules']->first(function ($s) use ($day, $start) {
                                                    return strtolower($s->day) === strtolower($day)
                                                        && substr($s->start_time, 0, 5) <= $start
                                                        && substr($s->end_time, 0, 5) > $start;
                                                });
                                            @endphp
                                            <td class="px-4 py-3">
                                                @if ($matched)
                                                    <a href="{{ route('admin.presence.show', [$matched->classroom_id, $matched->id]) }}"
                                                       class="block text-black rounded px-2 py-1 hover:bg-gray-200 transition">
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
    @endif

    {{-- Pagination --}}
    @if ($view === 'list' && $schedules instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-4">
            {{ $schedules->links() }}
        </div>
    @endif

</div>
@endsection
