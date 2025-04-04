@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.classrooms.index') }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <h2 class="text-2xl font-bold my-4">Create Classroom</h2>

    <form action="{{ route('admin.classrooms.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Classroom Name -->
        <div class="w-full">
            <label for="name" class="block text-sm font-medium text-gray-700">Classroom Name</label>
            <input type="text" name="name" id="name" required placeholder="Enter classroom name"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Assign Teacher -->
        <div class="w-full">
            <label for="teacher_id" class="block text-sm font-medium text-gray-700">Assign Teacher</label>
            <select name="teacher_id" id="teacher_id" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled selected>Select a Teacher</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md shadow-md hover:bg-blue-700 transition">
            Create Classroom
        </button>
    </form>
</div>
@endsection
