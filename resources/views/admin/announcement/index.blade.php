@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Manage Announcements</h2>
        <a href="{{ route('admin.announcements.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700 transition">
            + Create New Announcement
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="py-2 px-4 border-b">#</th>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Start Date</th>
                    <th class="py-2 px-4 border-b">End Date</th>
                    <th class="py-2 px-4 border-b">Roles</th>
                    <th class="py-2 px-4 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($announcements as $announcement)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border-b">{{ $announcement->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $announcement->start_date ?? 'No start date' }}</td>
                        <td class="py-2 px-4 border-b">{{ $announcement->end_date ?? 'No expiry' }}</td>
                        <td class="py-2 px-4 border-b gap-2">
                            <div class="flex flex-wrap gap-2">
                                @foreach ($announcement->roles as $role)
                                    <span class="bg-gray-200 rounded-full px-2 py-1 text-sm text-gray-800">{{ ucfirst($role) }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            <a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-yellow-500 hover:text-yellow-700 font-medium px-2">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium px-2"
                                    onclick="return confirm('Are you sure you want to delete this announcement?');">
                                    🗑 Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($announcements->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">No announcements found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
