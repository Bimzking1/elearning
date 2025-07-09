@extends('layouts.student.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Presence</h2>
        <div class="space-x-2">
            <button onclick="togglePresenceView('listView')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                List View
            </button>
            <button onclick="togglePresenceView('tableView')" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition">
                Table View
            </button>
        </div>
    </div>

    {{-- LIST VIEW --}}
    <div id="listView" class="presence-view hidden">
        @if ($presences->isEmpty())
            <p class="text-gray-600">No presence sessions yet.</p>
        @else
            <table class="w-full table-auto text-sm border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Subject</th>
                        <th class="px-4 py-2 text-left">Opened</th>
                        <th class="px-4 py-2 text-left">Closed</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach ($presences as $presence)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $presence->schedule->subject->name }}</td>
                            <td class="px-4 py-2">{{ $presence->opened_at->format('D, M j Y, H:i') }}</td>
                            <td class="px-4 py-2">
                                {{ $presence->closed_at ? $presence->closed_at->format('D, M j Y, H:i') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                @if ($presence->closed_at)
                                    <span class="text-gray-600">Closed</span>
                                @else
                                    <span class="text-green-600 font-semibold">Open</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('student.presence.schedule.history', $presence->schedule_id) }}"
                                   class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- TABLE VIEW --}}
    <div id="tableView" class="presence-view">
        <p class="mb-4 text-sm text-blue-600">
            📌 <span class="font-medium">Click the subject's name</span> to attend or view your presence.
        </p>
        @php
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            $timeSlots = ['19:00-20:00', '20:00-21:00', '21:00-21:30'];
        @endphp

        <div class="mb-10">
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
                                            @php
                                                $latestPresence = $presences->first(function ($p) use ($matched) {
                                                    return $p->schedule_id === $matched->id;
                                                });
                                            @endphp
                                            @if ($latestPresence)
                                                <a href="{{ route('student.presence.schedule.history', $matched->id) }}"
                                                    class="block text-black rounded-md px-2 py-1 hover:bg-gray-200 transition cursor-pointer">
                                                    <strong>{{ $matched->subject->name }}</strong><br>
                                                    <span class="text-xs text-gray-600">{{ $matched->teacher->user->name ?? '-' }}</span>
                                                </a>
                                            @else
                                                <div class="block text-black rounded-md px-2 py-1 bg-gray-100 cursor-not-allowed">
                                                    <strong>{{ $matched->subject->name }}</strong><br>
                                                    <span class="text-xs text-gray-400">{{ $matched->teacher->user->name ?? '-' }}</span>
                                                </div>
                                            @endif
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
</div>

<script>
    function togglePresenceView(viewId) {
        document.querySelectorAll('.presence-view').forEach(view => view.classList.add('hidden'));
        document.getElementById(viewId).classList.remove('hidden');
    }
</script>
@endsection
