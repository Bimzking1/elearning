@extends('layouts.dashboard')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold">Manage Classrooms</h2>
        <a href="{{ route('admin.classrooms.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700 transition">
            + Add Classroom
        </a>
    </div>

    <div class="mt-4">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Teacher</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classrooms as $index => $classroom)
                <tr class="text-center">
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $classroom->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $classroom->teacher->user->name ?? 'Unassigned' }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('admin.classrooms.edit', $classroom->id) }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition">Edit</a>

                        <form action="{{ route('admin.classrooms.destroy', $classroom->id) }}" method="POST"
                            class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 transition">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
