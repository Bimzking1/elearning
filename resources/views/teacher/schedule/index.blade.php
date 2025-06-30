@extends('layouts.teacher.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Teaching Schedule</h2>
    </div>

    <div class="mb-4 flex space-x-2">
        <button onclick="toggleTableView('listView')" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow transition">List View</button>
        <button onclick="toggleTableView('gridView')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow transition">Grid View</button>
    </div>

    <!-- List View -->
    <div id="listView" class="table-view overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="px-4 py-2 border">Day</th>
                    <th class="px-4 py-2 border">Time</th>
                    <th class="px-4 py-2 border">Subject</th>
                    <th class="px-4 py-2 border">Class</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($schedules as $schedule)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ ucfirst($schedule->day) }}</td>
                        <td class="px-4 py-2 border">{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
                        <td class="px-4 py-2 border">{{ $schedule->subject->name }}</td>
                        <td class="px-4 py-2 border">{{ $schedule->classroom->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">No teaching schedule yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Grid View -->
    <div id="gridView" class="table-view hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left w-1/6">Time</th>
                        @foreach ($days as $day)
                            <th class="px-4 py-3 text-left w-1/6">{{ $day }}</th>
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
                                        return strtolower($s->day) === strtolower($day)
                                            && substr($s->start_time, 0, 5) <= $start
                                            && substr($s->end_time, 0, 5) > $start;
                                    });
                                @endphp
                                <td class="px-4 py-3 text-gray-700">
                                    @if ($matched)
                                        <div>
                                            <strong>{{ $matched->subject->name }}</strong><br>
                                            <span class="text-gray-600 text-xs">Class Package {{ $matched->classroom->name }}</span>
                                        </div>
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
    function toggleTableView(viewId) {
        document.querySelectorAll('.table-view').forEach(view => view.classList.add('hidden'));
        document.getElementById(viewId).classList.remove('hidden');
    }
</script>
@endsection
