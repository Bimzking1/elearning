@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.schedules.index') }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>

    <h2 class="text-2xl font-bold my-4">Edit Schedule</h2>

    <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Classroom --}}
        <div class="mb-4">
            <label for="classroom_id" class="block text-sm font-medium text-gray-700">Classroom</label>
            <select name="classroom_id" id="classroom_id" class="w-full p-2 border border-gray-300 rounded-md">
                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ $schedule->classroom_id == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Subject --}}
        <div class="mb-4">
            <label for="subject_id" class="block text-sm font-medium text-gray-700">Subject</label>
            <select name="subject_id" id="subject_id" class="w-full p-2 border border-gray-300 rounded-md">
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $schedule->subject_id == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Teacher --}}
        <div class="mb-4">
            <label for="teacher_id" class="block text-sm font-medium text-gray-700">Teacher</label>
            <select name="teacher_id" id="teacher_id" class="w-full p-2 border border-gray-300 rounded-md">
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $schedule->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->user->name }} - ({{ $teacher->specialization }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Day --}}
        <div class="mb-4">
            <label for="day" class="block text-sm font-medium text-gray-700">Day</label>
            <select name="day" id="day" class="w-full p-2 border border-gray-300 rounded-md">
                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                    <option value="{{ $day }}" {{ $schedule->day === $day ? 'selected' : '' }}>{{ $day }}</option>
                @endforeach
            </select>
        </div>

        {{-- Time Slot --}}
        <div class="mb-4">
            <label for="time_slot" class="block text-sm font-medium text-gray-700">Time Slot</label>
            <select name="time_slot" id="time_slot" class="w-full p-2 border border-gray-300 rounded-md" required>
                <option value="" disabled>Select Time Slot</option>
                <option value="19:00:00-20:00:00" {{ $time_slot == '19:00:00-20:00:00' ? 'selected' : '' }}>19:00 - 20:00</option>
                <option value="20:00:00-21:00:00" {{ $time_slot == '20:00:00-21:00:00' ? 'selected' : '' }}>20:00 - 21:00</option>
                <option value="21:00:00-21:30:00" {{ $time_slot == '21:00:00-21:30:00' ? 'selected' : '' }}>21:00 - 21:30</option>
            </select>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                Update Schedule
            </button>
        </div>
    </form>
</div>
@endsection
