@extends('layouts.student.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Jadwal Pelajaran - Paket {{ $classroom->name }}</h2>

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
@endsection
