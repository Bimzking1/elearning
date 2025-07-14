@extends('layouts.admin.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ url('/admin/presence') }}"
           class="inline-flex items-center text-sm text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg font-medium transition">
            ← Back
        </a>
    </div>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ $schedule->subject->name }} - Class {{ $classroom->name }}
        </h2>

        <button type="button"
            onclick="document.getElementById('openPresenceModal').classList.remove('hidden')"
            class="w-full md:w-auto text-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow font-semibold">
            + Open New Presence
        </button>
    </div>

    {{-- NEW: Search Bar --}}
    <form method="GET" class="mb-4 flex flex-col md:flex-row gap-2 items-center">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by presence name"
            class="w-full md:w-1/3 border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-300">

        <div class="flex gap-2">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                Search
            </button>

            @if(request('search'))
                <a href="{{ url()->current() }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 transition">
                    Clear Search
                </a>
            @endif
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[1000px] table-auto bg-white border border-gray-300 text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase">
                <tr>
                    @php
                        function sortLink($label, $column, $sort, $direction) {
                            $isSorted = $sort === $column;
                            $newDirection = ($isSorted && $direction === 'asc') ? 'desc' : 'asc';
                            $arrow = $isSorted ? ($direction === 'asc' ? '↑' : '↓') : '';
                            $url = request()->fullUrlWithQuery(['sort' => $column, 'direction' => $newDirection]);
                            return '<a href="'.$url.'" class="hover:underline">'.$label.' '.$arrow.'</a>';
                        }
                    @endphp
                    <th class="px-4 py-3 text-left">{!! sortLink('ID', 'id', $sort, $direction) !!}</th>
                    <th class="px-4 py-3 text-left">{!! sortLink('Name', 'name', $sort, $direction) !!}</th>
                    <th class="px-4 py-3 text-left">Class</th>
                    <th class="px-4 py-3 text-left">Time</th>
                    <th class="px-4 py-3 text-left">{!! sortLink('Date Opened', 'opened_at', $sort, $direction) !!}</th>
                    <th class="px-4 py-3 text-left">{!! sortLink('Date Re-Opened', 'reopened_at', $sort, $direction) !!}</th>
                    <th class="px-4 py-3 text-left">{!! sortLink('Last Date Closed', 'closed_at', $sort, $direction) !!}</th>
                    <th class="px-4 py-3 text-left">{!! sortLink('Status', 'status', $sort, $direction) !!}</th>
                    <th class="px-4 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse ($presences as $presence)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $presence->id }}</td>
                        <td class="px-4 py-2">{{ $presence->name }}</td>
                        <td class="px-4 py-2">{{ $classroom->name }}</td>
                        <td class="px-4 py-2">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                        <td class="px-4 py-2">{{ $presence->opened_at?->format('D, M j Y, H:i') }}</td>
                        <td class="px-4 py-2">{{ $presence->reopened_at?->format('D, M j Y, H:i') ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $presence->closed_at?->format('D, M j Y, H:i') ?? '-' }}</td>
                        <td class="px-4 py-2 font-medium">
                            @if (is_null($presence->closed_at))
                                <span class="text-green-600">Open</span>
                            @else
                                <span class="text-gray-600">Closed</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex flex-wrap gap-2">
                                @if (is_null($presence->closed_at))
                                    <form action="{{ route('admin.presence.close', [$classroom->id, $schedule->id, $presence->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1 bg-red-100 text-red-600 text-xs font-semibold rounded hover:bg-red-200">
                                            Close
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.presence.reopen', [$classroom->id, $schedule->id, $presence->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded hover:bg-yellow-200">
                                            Reopen
                                        </button>
                                    </form>
                                @endif

                                <button type="button"
                                    onclick="openEditModal({{ $presence->id }}, '{{ addslashes($presence->name) }}')"
                                    class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded hover:bg-indigo-200">
                                    Edit
                                </button>

                                <a href="{{ route('admin.presence.view', [$classroom->id, $schedule->id, $presence->id]) }}"
                                    class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded hover:bg-blue-200">
                                    View
                                </a>

                                <form action="{{ route('admin.presence.destroy', [$classroom->id, $schedule->id, $presence->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this presence?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded hover:bg-gray-200">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-gray-500 py-4">No presence history found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- NEW: Pagination --}}
    <div class="mt-6">
        {{ $presences->links() }}
    </div>

    <div id="openPresenceModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Open New Presence</h3>
            <form action="{{ route('admin.presence.open', [$classroom->id, $schedule->id]) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Presence Name</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button"
                            onclick="document.getElementById('openPresenceModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Open
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="editPresenceModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Edit Presence Name</h3>
            <form id="editPresenceForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_name" class="block text-sm font-medium text-gray-700">Presence Name</label>
                    <input type="text" name="name" id="edit_name" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button"
                            onclick="document.getElementById('editPresenceModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
