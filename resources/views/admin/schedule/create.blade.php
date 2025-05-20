@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Create Schedule</h2>

    <form action="{{ route('admin.schedules.store') }}" method="POST">
        @csrf

        {{-- Classroom --}}
        <div class="mb-4">
            <label for="classroom_id" class="block text-sm font-medium text-gray-700">Classroom</label>
            <select name="classroom_id" id="classroom_id" class="w-full p-2 border border-gray-300 rounded-md">
                <option value="" disabled selected>Select Classroom</option>
                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Subject --}}
        <div class="mb-4">
            <label for="subject_id" class="block text-sm font-medium text-gray-700">Subject</label>
            <select name="subject_id" id="subject_id" class="w-full p-2 border border-gray-300 rounded-md">
                <option value="" disabled selected>Select Subject</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Teacher --}}
        <div class="mb-4">
            <label for="teacher_id" class="block text-sm font-medium text-gray-700">Teacher</label>
            <select name="teacher_id" id="teacher_id" class="w-full p-2 border border-gray-300 rounded-md">
                <option value="" disabled selected>Select Teacher</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->user->name }} - ({{ $teacher->specialization }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Day --}}
        <div class="mb-4">
            <label for="day" class="block text-sm font-medium text-gray-700">Day</label>
            <select name="day" id="day" class="w-full p-2 border border-gray-300 rounded-md">
                <option value="" disabled selected>Select Day</option>
                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                    <option value="{{ $day }}" {{ old('day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                @endforeach
            </select>
        </div>

        {{-- Start Time --}}
        <div class="mb-4">
            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('start_time') }}" required>
        </div>

        {{-- End Time --}}
        <div class="mb-4">
            <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
            <input type="time" name="end_time" id="end_time" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('end_time') }}" required>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Save Schedule</button>
        </div>
    </form>
</div>
@endsection
