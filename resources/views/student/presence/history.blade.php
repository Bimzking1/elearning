@extends('layouts.student.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('student.presence.index') }}"
           class="inline-flex items-center text-sm text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg font-medium transition">
            ← Back
        </a>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-4">
        Presence History – {{ $presences->first()?->schedule->subject->name ?? 'Unknown Subject' }}
    </h2>

    @if ($presences->isEmpty())
        <p class="text-gray-600">No presence sessions found for this schedule.</p>
    @else
        <table class="w-full table-auto border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-4 py-2">#</th> <!-- Incremental number -->
                    <th class="text-left px-4 py-2">Name</th> <!-- Presence name -->
                    <th class="text-left px-4 py-2">Opened</th>
                    <th class="text-left px-4 py-2">Closed</th>
                    <th class="text-left px-4 py-2">Status</th>
                    <th class="text-left px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach ($presences as $presence)
                    @php
                        $alreadySubmitted = $presence->submissions()
                            ->where('student_id', auth()->user()->student->id)
                            ->exists();
                    @endphp
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
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
    @endif
</div>
@endsection
