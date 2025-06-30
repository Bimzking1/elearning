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
                    @php
                        $specs = is_array($teacher->specialization)
                            ? $teacher->specialization
                            : json_decode($teacher->specialization, true);
                    @endphp
                    <option value="{{ $teacher->id }}" {{ $schedule->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->user->name }}
                        @if (!empty($specs))
                            - ({{ implode(', ', $specs) }})
                        @endif
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

        @php
            $availableSlots = ['19:00:00-20:00:00', '20:00:00-21:00:00', '21:00:00-21:30:00'];
        @endphp

        {{-- Time Slot --}}
        <div class="mb-4">
            <label for="time_slot" class="block text-sm font-medium text-gray-700">Time Slot</label>
            <select name="time_slot" id="time_slot" class="w-full p-2 border border-gray-300 rounded-md" required>
                <option value="" disabled>Select Time Slot</option>
                @foreach ($availableSlots as $slot)
                    @php
                        [$start, $end] = explode('-', $slot);
                        $formattedStart = \Carbon\Carbon::createFromFormat('H:i:s', $start)->format('H:i');
                        $formattedEnd = \Carbon\Carbon::createFromFormat('H:i:s', $end)->format('H:i');
                        $isTaken = $occupiedSlots[$schedule->classroom_id][$schedule->day] ?? [];
                        $disabled = in_array($slot, $isTaken);
                    @endphp
                    <option value="{{ $slot }}" {{ $time_slot === $slot ? 'selected' : '' }} {{ $disabled ? 'disabled' : '' }}>
                        {{ $formattedStart }} - {{ $formattedEnd }}{{ $disabled ? ' (Not Available)' : '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                Update Schedule
            </button>
        </div>
    </form>
</div>

<script>
    const allSlots = @json($availableSlots);
    const occupied = @json($occupiedSlots);
    const selectedSlot = "{{ $time_slot }}";

    const classroomSelect = document.getElementById('classroom_id');
    const daySelect = document.getElementById('day');
    const timeSlotSelect = document.getElementById('time_slot');

    const formatTime = (timeString) => {
        const [hour, minute] = timeString.split(':');
        return `${hour}:${minute}`;
    };

    function updateTimeSlotOptions() {
        const classroomId = classroomSelect.value;
        const selectedDay = daySelect.value;

        timeSlotSelect.innerHTML = '<option value="" disabled>Select Time Slot</option>';

        allSlots.forEach(slot => {
            const [start, end] = slot.split('-');
            const isTaken = occupied?.[classroomId]?.[selectedDay]?.includes(slot);
            const option = document.createElement('option');
            option.value = slot;
            option.textContent = `${formatTime(start)} - ${formatTime(end)}${isTaken ? ' (Not Available)' : ''}`;
            option.disabled = !!isTaken;

            if (slot === selectedSlot) {
                option.selected = true;
            }

            timeSlotSelect.appendChild(option);
        });
    }

    classroomSelect.addEventListener('change', updateTimeSlotOptions);
    daySelect.addEventListener('change', updateTimeSlotOptions);
    updateTimeSlotOptions();
</script>

@endsection
