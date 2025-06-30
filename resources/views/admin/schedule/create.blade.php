@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.schedules.index') }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <h2 class="text-2xl font-bold my-4">Create Schedule</h2>

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

        @php
            $availableSlots = ['19:00:00-20:00:00', '20:00:00-21:00:00', '21:00:00-21:30:00'];
        @endphp

        {{-- Time Slot --}}
        <div class="mb-4">
            <label for="time_slot" class="block text-sm font-medium text-gray-700">Time Slot</label>
            <select name="time_slot" id="time_slot" class="w-full p-2 border border-gray-300 rounded-md" required>
                <option value="" disabled {{ old('time_slot') ? '' : 'selected' }}>Select Time Slot</option>
                @foreach ($availableSlots as $slot)
                    @php
                        [$start, $end] = explode('-', $slot);
                        $formattedStart = \Carbon\Carbon::createFromFormat('H:i:s', $start)->format('H:i');
                        $formattedEnd = \Carbon\Carbon::createFromFormat('H:i:s', $end)->format('H:i');
                    @endphp
                    <option value="{{ $slot }}" {{ old('time_slot') == $slot ? 'selected' : '' }}>
                        {{ $formattedStart }} - {{ $formattedEnd }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Save Schedule</button>
        </div>
    </form>
</div>

<script>
    const allSlots = @json($availableSlots);
    const occupied = @json($occupiedSlots);

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

        // Reset options
        timeSlotSelect.innerHTML = '<option value="" disabled selected>Select Time Slot</option>';

        allSlots.forEach(slot => {
            const isTaken = occupied?.[classroomId]?.[selectedDay]?.includes(slot);
            const option = document.createElement('option');
            option.value = slot;

            const [start, end] = slot.split('-');
            option.textContent = `${formatTime(start)} - ${formatTime(end)}${isTaken ? ' (Not Available)' : ''}`;
            option.disabled = !!isTaken;

            if (slot === "{{ old('time_slot') }}") {
                option.selected = true;
            }

            timeSlotSelect.appendChild(option);
        });
    }

    classroomSelect.addEventListener('change', updateTimeSlotOptions);
    daySelect.addEventListener('change', updateTimeSlotOptions);

    // Initialize on page load
    updateTimeSlotOptions();
</script>

@endsection
