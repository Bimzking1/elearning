@extends('layouts.dashboard')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Manage Students</h2>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.students.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700 transition">
            + Add Student
        </a>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Classroom</th>
                <th class="border border-gray-300 px-4 py-2">Phone</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $index => $student)
                <tr class="text-center">
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $student->user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $student->classroom->name ?? 'N/A' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $student->phone }}</td>
                    <td class="border border-gray-300 px-4 py-2 space-x-2">
                        <a href="{{ route('admin.students.edit', $student->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                            Edit
                        </a>
                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 transition"
                                    onclick="return confirm('Are you sure you want to delete this student?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
