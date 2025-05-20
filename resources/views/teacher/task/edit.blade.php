@extends('layouts.teacher.dashboard')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('teacher.tasks.index') }}" class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <h2 class="text-2xl font-bold my-4">Edit Task</h2>

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

    <form action="{{ route('teacher.tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="w-full">
            <label for="title" class="block text-sm font-medium text-gray-700">Task Title</label>
            <input placeholder="Input Task Title" type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('title')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full">
            <label for="classroom_id" class="block text-sm font-medium text-gray-700">Classroom</label>
            <select name="classroom_id" id="classroom_id" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                <option value="" disabled>Select a Classroom</option>
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ old('classroom_id', $task->classroom_id) == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
            @error('classroom_id')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full">
            <label for="description" class="block text-sm font-medium text-gray-700">Task Description</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full">
            <label for="attachment_path" class="block text-sm font-medium text-gray-700">Attachment (Optional)</label>
            <input type="file" name="attachment_path" id="attachment_path"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('attachment_path')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
            @if ($task->attachment_path)
                <p class="text-sm mt-2">Current Attachment: <a href="{{ Storage::url($task->attachment_path) }}" class="text-blue-600" target="_blank">View</a></p>
            @endif
        </div>

        <input type="hidden" name="subject_id" value="{{ auth()->user()->teacher->specialization }}">
        <input type="hidden" name="teacher_id" value="{{ auth()->user()->teacher->id }}">

        <div class="w-full">
            <label for="deadline" class="block text-sm font-medium text-gray-700">Due Date</label>
            <input type="datetime-local" name="deadline" id="deadline"
                value="{{ old('deadline', $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d\TH:i') : '') }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('deadline')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md shadow-md hover:bg-blue-700 transition">
            Update Task
        </button>
    </form>
</div>
@endsection
