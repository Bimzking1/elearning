@extends('layouts.teacher.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">My Presence Schedule</h2>
        <div class="space-x-2">
            <button onclick="togglePresenceView('listView')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                List View
            </button>
            <button onclick="togglePresenceView('tableView')" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition">
                Table View
            </button>
        </div>
    </div>

    {{-- List View --}}
    <div id="listView" class="presence-view hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border rounded-lg overflow-hidden shadow text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">Class</th>
                        <th class="px-4 py-3 text-left">Day</th>
                        <th class="px-4 py-3 text-left">Time</th>
                        <th class="px-4 py-3 text-left">Subject</th>
                        <th class="px-4 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @forelse($schedules as $schedule)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $schedule->classroom->name }}</td>
                            <td class="px-4 py-3 capitalize">{{ $schedule->day }}</td>
                            <td class="px-4 py-3">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                            <td class="px-4 py-3">{{ $schedule->subject->name ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('teacher.presence.show', [$schedule->classroom_id, $schedule->id]) }}"
                                class="text-blue-600 font-medium hover:underline">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">No schedules found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Table View --}}
    <div id="tableView" class="presence-view">
        @php
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            $timeSlots = ['19:00-20:00', '20:00-21:00', '21:00-21:30'];
        @endphp

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
                                    $matched = $schedules->first(function ($s) use ($day, $start) {
                                        return strtolower($s->day) === strtolower($day) &&
                                            substr($s->start_time, 0, 5) <= $start &&
                                            substr($s->end_time, 0, 5) > $start;
                                    });
                                @endphp
                                <td class="px-4 py-3 text-gray-700">
                                    @if ($matched)
                                        <a href="{{ route('teacher.presence.show', [$matched->classroom_id, $matched->id]) }}"
                                        class="block text-black rounded-md px-2 py-1 hover:bg-gray-200 transition cursor-pointer">
                                            <strong>{{ $matched->subject->name }}</strong><br>
                                            <span class="text-xs">{{ $matched->classroom->name }}</span>
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
</div>

<script>
    function togglePresenceView(viewId) {
        document.querySelectorAll('.presence-view').forEach(view => view.classList.add('hidden'));
        document.getElementById(viewId).classList.remove('hidden');
    }
</script>
@endsection
