@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Manage Students</h2>
        <a href="{{ route('admin.students.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add Student
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Classroom</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($students as $index => $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $student->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $student->classroom->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $student->phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.students.edit', $student->id) }}"
                                   class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded-md text-sm shadow-md transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this student?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded-md text-sm shadow-md transition">
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
</div>
@endsection
