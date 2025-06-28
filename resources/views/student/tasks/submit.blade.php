@extends('layouts.student.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow-md space-y-6">

    {{-- Back Button --}}
    <a href="{{ route('student.tasks.index') }}"
       class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow-sm text-sm transition">
        ← Back
    </a>

    {{-- Task Title --}}
    <div>
        <h2 class="text-3xl font-bold text-gray-900">{{ $task->title }}</h2>
    </div>

    {{-- Task Info --}}
    <div class="bg-gray-50 border rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Task Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm text-gray-700">

            {{-- Subject --}}
            <div class="flex flex-wrap md:flex-nowrap items-start gap-2">
                <span class="min-w-[8rem] font-medium text-gray-600">Subject:</span>
                <span class="text-gray-800">{{ $task->subject->name ?? '-' }}</span>
            </div>

            {{-- Teacher --}}
            <div class="flex flex-wrap md:flex-nowrap items-start gap-2">
                <span class="min-w-[8rem] font-medium text-gray-600">Teacher:</span>
                <span class="text-gray-800">{{ $task->teacher && $task->teacher->user ? $task->teacher->user->name : '-' }}</span>
            </div>

            {{-- Email --}}
            <div class="flex flex-wrap md:flex-nowrap items-start gap-2">
                <span class="min-w-[8rem] font-medium text-gray-600">Assigner's Email:</span>
                <span class="text-gray-800">{{ $task->teacher && $task->teacher->user ? $task->teacher->user->email : '-' }}</span>
            </div>

            {{-- Phone --}}
            <div class="flex flex-wrap md:flex-nowrap items-start gap-2">
                <span class="min-w-[8rem] font-medium text-gray-600">Assigner's Phone:</span>
                <span class="text-gray-800">{{ $task->teacher ? ($task->teacher->phone ?? '-') : '-' }}</span>
            </div>

        </div>
    </div>

    {{-- Description --}}
    @if ($task->description)
        <div class="bg-gray-50 border rounded-lg p-6">
            <h3 class="text-md font-semibold text-gray-800 mb-2">Description</h3>
            <p class="text-sm text-gray-600">{{ $task->description }}</p>
        </div>
    @endif

    {{-- Deadline --}}
    @if ($task->deadline)
        @php
            $deadline = \Carbon\Carbon::parse($task->deadline);
            $now = now();

            $diffInMinutes = $now->diffInMinutes($deadline, false);
            $isPast = $diffInMinutes < 0;
            $absMinutes = abs($diffInMinutes);

            $days = floor($absMinutes / 1440);
            $hours = floor(($absMinutes % 1440) / 60);
            $minutes = $absMinutes % 60;

            $isLessThanOneHour = !$isPast && $absMinutes < 60;
            $deadlineTextClass = $isLessThanOneHour ? 'text-red-600' : 'text-gray-600';
        @endphp

        <div class="bg-gray-50 border rounded-lg p-6">
            <h3 class="text-md font-semibold text-gray-800 mb-2">Deadline</h3>
            <p class="text-sm {{ $deadlineTextClass }}">
                {{ $deadline->format('F j, Y') }} - {{ $deadline->format('H:i') }}

                @if (!$isPast)
                    <span class="font-medium ml-2 text-sm">(
                        @if ($days >= 1)
                            {{ $days }} day{{ $days > 1 ? 's' : '' }}
                        @elseif ($hours >= 1)
                            {{ $hours }} hour{{ $hours > 1 ? 's' : '' }}
                        @endif

                        @if ($days < 1 && $minutes >= 1)
                            {{ $minutes }} minute{{ $minutes > 1 ? 's' : '' }}
                        @endif
                    )</span>
                @else
                    <span class="text-red-500 font-semibold ml-2">(Past Deadline)</span>
                @endif
            </p>
        </div>
    @endif

    {{-- Submission Form --}}
    <form action="{{ route('student.tasks.store', $task->id) }}" method="POST" enctype="multipart/form-data"
          class="bg-gray-50 border rounded-lg p-6 space-y-6">
        @csrf

        {{-- Submission Text --}}
        <div>
            <label for="submission_text" class="block text-sm font-medium text-gray-700 mb-1">
                Submission Text
            </label>
            <textarea name="submission_text" id="submission_text" rows="5"
                      class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-200 focus:border-blue-400">{{ old('submission_text') }}</textarea>
            @error('submission_text')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submission File --}}
        <div>
            <label for="submission_file" class="block text-sm font-medium text-gray-700 mb-1">
                Attach File (optional)
            </label>
            <input type="file" name="submission_file" id="submission_file"
                   class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-200 focus:border-blue-400">
            @error('submission_file')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-md shadow-md text-sm transition">
                Submit Task
            </button>
        </div>
    </form>
</div>
@endsection
