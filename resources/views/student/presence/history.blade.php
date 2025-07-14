@extends('layouts.student.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('student.presence.index') }}"
           class="inline-flex items-center text-sm text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg font-medium transition">
            ← Back
        </a>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Presence History – {{ $presences->first()?->schedule->subject->name ?? 'Unknown Subject' }}
    </h2>

    {{-- Search and Clear --}}
    <form method="GET" class="mb-4 flex gap-2 flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search presence name"
               class="w-full md:w-64 border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring focus:border-blue-300">

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
            Search
        </button>

        @if(request('search'))
            <a href="{{ route('student.presence.schedule.history', $scheduleId) }}"
               class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 transition">
                Clear Search
            </a>
        @endif
    </form>

    {{-- Table --}}
    @if ($presences->isEmpty())
        <p class="text-gray-600">No presence sessions found for this schedule.</p>
    @else
        @php
            function sortLink($label, $column, $sort, $direction, $scheduleId) {
                $newDirection = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';
                $arrow = $sort === $column ? ($direction === 'asc' ? '↑' : '↓') : '';
                $url = route('student.presence.schedule.history', $scheduleId) . '?' . http_build_query([
                    'search' => request('search'),
                    'sort' => $column,
                    'direction' => $newDirection,
                ]);
                return '<a href="' . $url . '" class="hover:underline">' . $label . ' ' . $arrow . '</a>';
            }
        @endphp

        <div class="overflow-x-auto">
            <table class="w-full table-auto border text-sm shadow-sm bg-white">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="text-left px-4 py-2 w-10">#</th>
                        <th class="text-left px-4 py-2">{!! sortLink('Name', 'name', $sort, $direction, $scheduleId) !!}</th>
                        <th class="text-left px-4 py-2">{!! sortLink('Opened', 'opened_at', $sort, $direction, $scheduleId) !!}</th>
                        <th class="text-left px-4 py-2">{!! sortLink('Closed', 'closed_at', $sort, $direction, $scheduleId) !!}</th>
                        <th class="text-left px-4 py-2">Status</th>
                        <th class="text-left px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach ($presences as $index => $presence)
                        @php
                            $alreadySubmitted = $presence->submissions()
                                ->where('student_id', auth()->user()->student->id)
                                ->exists();
                        @endphp
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">
                                {{ ($presences->currentPage() - 1) * $presences->perPage() + $index + 1 }}
                            </td>
                            <td class="px-4 py-2">{{ $presence->name }}</td>
                            <td class="px-4 py-2">{{ $presence->opened_at->format('D, M j Y, H:i') }}</td>
                            <td class="px-4 py-2">
                                {{ $presence->closed_at ? $presence->closed_at->format('D, M j Y, H:i') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                @if ($alreadySubmitted)
                                    <span class="text-green-700 font-medium">Submitted</span>
                                @elseif ($presence->closed_at)
                                    <span class="text-gray-600">Closed</span>
                                @else
                                    <span class="text-yellow-700 font-medium">Open</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('student.presence.show', $presence->id) }}"
                                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                    Attend Class
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $presences->links() }}
        </div>
    @endif
</div>
@endsection
