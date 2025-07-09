@extends('layouts.teacher.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ url('/teacher/presence') }}"
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

    <div class="overflow-x-auto">
        <table class="w-full min-w-[1000px] table-auto bg-white border border-gray-300 text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Subject</th>
                    <th class="px-4 py-3 text-left">Class</th>
                    <th class="px-4 py-3 text-left">Time</th>
                    <th class="px-4 py-3 text-left">Date Opened</th>
                    <th class="px-4 py-3 text-left">Date Re-Opened</th>
                    <th class="px-4 py-3 text-left">Last Date Closed</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse ($presences as $presence)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $presence->id }}</td>
                        <td class="px-4 py-2">{{ $presence->name }}</td>
                        <td class="px-4 py-2">{{ $schedule->subject->name }}</td>
                        <td class="px-4 py-2">{{ $classroom->name }}</td>
                        <td class="px-4 py-2">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                        <td class="px-4 py-2">{{ $presence->opened_at->format('D, M j Y, H:i') }}</td>
                        <td class="px-4 py-2">
                            {{ $presence->reopened_at ? $presence->reopened_at->format('D, M j Y, H:i') : '-' }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $presence->closed_at ? $presence->closed_at->format('D, M j Y, H:i') : '-' }}
                        </td>
                        <td class="px-4 py-2 font-medium">
                            @if ($presence->closed_at === null)
                                <span class="text-green-600">Open</span>
                            @else
                                <span class="text-gray-600">Closed</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex flex-wrap gap-2">
                                @if ($presence->closed_at === null)
                                    <form action="{{ route('teacher.presence.close', ['classroom' => $classroom->id, 'schedule' => $schedule->id, 'presence' => $presence->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-600 text-xs font-semibold rounded hover:bg-red-200">
                                            Close
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('teacher.presence.reopen', ['classroom' => $classroom->id, 'schedule' => $schedule->id, 'presence' => $presence->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded hover:bg-yellow-200">
                                            Reopen
                                        </button>
                                    </form>
                                @endif

                                <button type="button"
                                        onclick="openEditModal('{{ route('teacher.presence.updateName', ['presence' => $presence->id]) }}', '{{ e($presence->name) }}')"
                                        class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded hover:bg-indigo-200">
                                    Edit
                                </button>

                                <a href="{{ route('teacher.presence.view', ['classroom' => $classroom->id, 'schedule' => $schedule->id, 'presence' => $presence->id]) }}"
                                   class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded hover:bg-blue-200">
                                    View
                                </a>

                                <form action="{{ route('teacher.presence.destroy', ['classroom' => $classroom->id, 'schedule' => $schedule->id, 'presence' => $presence->id]) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this presence?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded hover:bg-gray-200">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-gray-500 py-4">No presence history yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Open Modal --}}
    <div id="openPresenceModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Open New Presence</h3>
            <form action="{{ route('teacher.presence.open', ['classroom' => $classroom->id, 'schedule' => $schedule->id]) }}" method="POST">
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
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Open
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
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

{{-- Scripts --}}
<script>
    function openEditModal(actionUrl, presenceName) {
        document.getElementById('editPresenceForm').action = actionUrl;
        document.getElementById('edit_name').value = presenceName;
        document.getElementById('editPresenceModal').classList.remove('hidden');
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape") {
            document.getElementById('openPresenceModal').classList.add('hidden');
            document.getElementById('editPresenceModal').classList.add('hidden');
        }
    });

    document.addEventListener('click', function (event) {
        const openModal = document.getElementById('openPresenceModal');
        const editModal = document.getElementById('editPresenceModal');
        if (event.target === openModal) openModal.classList.add('hidden');
        if (event.target === editModal) editModal.classList.add('hidden');
    });
</script>
@endsection
