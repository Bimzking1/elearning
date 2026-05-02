@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.tasks.index') }}"
           class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <h2 class="text-2xl font-bold my-4">Create Task</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded-md">
            <strong>Oops! Something went wrong:</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="w-full">
            <label for="title" class="block text-sm font-medium text-gray-700">Task Title</label>
            <input placeholder="Input Task Title" type="text" name="title" id="title" value="{{ old('title') }}" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('title')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full">
            <label for="subject_id" class="block text-sm font-medium text-gray-700">Subject</label>
            <select name="subject_id" id="subject_id" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                <option value="" disabled selected>Select a Subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
            @error('subject_id')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full">
            <label class="block text-sm font-medium text-gray-700 mb-2">Classrooms</label>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
                @foreach($classrooms as $classroom)
                    <label class="flex items-center space-x-3 p-3 border rounded-md bg-white shadow-sm hover:shadow-md cursor-pointer transition-all">
                        <input type="checkbox" name="classroom_id[]" value="{{ $classroom->id }}"
                            {{ (is_array(old('classroom_id')) && in_array($classroom->id, old('classroom_id'))) ? 'checked' : '' }}
                            class="form-checkbox h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-200">
                        <span class="text-gray-800 text-sm font-medium truncate">{{ $classroom->name }}</span>
                    </label>
                @endforeach
            </div>

            @error('classroom_id')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="3" placeholder="Task Description"
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full">
            <label for="attachment_path" class="block text-sm font-medium text-gray-700">Attachment</label>
            <input type="file" name="attachment_path" id="attachment_path"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('attachment_path')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        @if(auth()->user()->role === 'admin')
            <div class="w-full">
                <label for="teacher_id" class="block text-sm font-medium text-gray-700">Assign Teacher</label>
                <select name="teacher_id" id="teacher_id" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    <option value="" disabled selected>Select a Teacher</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->user->name }}
                            @php
                                $specs = is_array($teacher->specialization)
                                    ? $teacher->specialization
                                    : json_decode($teacher->specialization, true);
                            @endphp
                            @if (!empty($specs))
                                - ({{ implode(', ', $specs) }})
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        @elseif(auth()->user()->role === 'teacher')
            <input type="hidden" name="teacher_id" value="{{ auth()->user()->teacher->id }}">
        @endif

        <div class="w-full">
            <label for="deadline" class="block text-sm font-medium text-gray-700">Due Date</label>
            <input type="datetime-local" name="deadline" id="deadline" value="{{ old('deadline') }}" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('deadline')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md shadow-md hover:bg-blue-700 transition">
            Create Task
        </button>
    </form>
</div>
@endsection
