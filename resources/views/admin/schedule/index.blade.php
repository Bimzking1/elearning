@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Manage Schedules</h2>
        <a href="{{ route('admin.schedules.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add Schedule
        </a>
    </div>

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
                    <th class="w-1/6 px-4 py-3 text-left">Classroom</th>
                    <th class="w-1/6 px-4 py-3 text-left">Subject</th>
                    <th class="w-1/6 px-4 py-3 text-left">Teacher</th>
                    <th class="w-1/6 px-4 py-3 text-left">Day</th>
                    <th class="w-1/6 px-4 py-3 text-left">Time</th>
                    <th class="w-32 px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($schedules as $index => $schedule)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">{{ $schedule->classroom->name }}</td>
                        <td class="px-4 py-3">{{ $schedule->subject->name }}</td>
                        <td class="px-4 py-3">{{ $schedule->teacher->user->name }}</td>
                        <td class="px-4 py-3">{{ $schedule->day }}</td>
                        <td class="px-4 py-3">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.schedules.edit', $schedule->id) }}"
                                   class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded-md shadow text-sm transition">Edit</a>
                                <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this schedule?');" class="inline-block">
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
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Table View -->
    <div id="table2" class="table-view">
        @php
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            $timeSlots = ['18:00-19:00', '19:00-20:00', '20:00-21:00'];
        @endphp

        @foreach ($classrooms as $classroom)
            <div class="mb-10">
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Jadwal Pelajaran Paket {{ $classroom->name }}</h3>
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
                                            $matched = $schedules->first(function ($s) use ($classroom, $day, $start, $end) {
                                                return $s->classroom_id == $classroom->id &&
                                                    strtolower($s->day) === strtolower($day) &&
                                                    substr($s->start_time, 0, 5) <= $start &&
                                                    substr($s->end_time, 0, 5) > $start;
                                            });
                                        @endphp
                                        <td class="px-4 py-3 text-gray-700">
                                            @if ($matched)
                                                <div>
                                                    <strong>{{ $matched->subject->name }}</strong><br>
                                                    <span class="text-gray-600 text-xs">{{ $matched->teacher->user->name }}</span>
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
        @endforeach
    </div>
</div>

<script>
    function toggleTableView(tableId) {
        document.querySelectorAll('.table-view').forEach(table => table.classList.add('hidden'));
        document.getElementById(tableId).classList.remove('hidden');
    }
</script>
@endsection
