@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Manage Teachers</h2>
        <a href="{{ route('admin.teacher.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700 transition">
            + Create New Teacher
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="py-2 px-4 border-b">#</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Specialization</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Role</th>
                    <th class="py-2 px-4 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->teacher->specialization ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b capitalize">{{ $user->role }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <a href="{{ route('admin.teacher.edit', $user) }}" class="text-yellow-500 hover:text-yellow-700 font-medium px-2">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.teacher.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium px-2"
                                    onclick="return confirm('Are you sure you want to delete this user?');">
                                    🗑 Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($users->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">No users found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
