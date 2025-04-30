@extends('layouts.admin.dashboard')
@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Schedule</h1>

    <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Classroom --}}
        <div>
            <label for="classroom_id" class="block text-sm font-semibold text-gray-700 mb-1">Classroom</label>
            <select name="classroom_id" id="classroom_id" class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200">
                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ $schedule->classroom_id == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Subject --}}
        <div>
            <label for="subject_id" class="block text-sm font-semibold text-gray-700 mb-1">Subject</label>
            <select name="subject_id" id="subject_id" class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200">
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $schedule->subject_id == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Teacher --}}
        <div>
            <label for="teacher_id" class="block text-sm font-semibold text-gray-700 mb-1">Teacher</label>
            <select name="teacher_id" id="teacher_id" class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200">
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $schedule->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Day --}}
        <div>
            <label for="day" class="block text-sm font-semibold text-gray-700 mb-1">Day</label>
            <select name="day" id="day" class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200">
                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                    <option value="{{ $day }}" {{ $schedule->day === $day ? 'selected' : '' }}>{{ $day }}</option>
                @endforeach
            </select>
        </div>

        {{-- Start Time --}}
        <div>
            <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-1">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" value="{{ $schedule->start_time }}" required>
        </div>

        {{-- End Time --}}
        <div>
            <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-1">End Time</label>
            <input type="time" name="end_time" id="end_time" class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" value="{{ $schedule->end_time }}" required>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg transition">
                Update Schedule
            </button>
        </div>
    </form>
</div>
@endsection
