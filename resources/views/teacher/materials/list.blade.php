@extends('layouts.teacher.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('teacher.materials.index') }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <div class="flex justify-between items-center mt-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Subjects in {{ $classroom->name }}</h2>
        <a href="{{ route('teacher.materials.create') }}?classroom_id={{ $classroom->id }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add New Material
        </a>
    </div>

    @if($classroom->materials->count())
        @php
            $subjects = $classroom->materials->pluck('subject')->unique('id')->filter(function ($subject) use ($teacher) {
                $specializations = is_array($teacher->specialization)
                    ? $teacher->specialization
                    : array_map('trim', explode(',', $teacher->specialization));
                return in_array($subject->name, $specializations);
            });
        @endphp

        @if($subjects->count())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($subjects as $subject)
                    <a href="{{ route('teacher.materials.bySubject', $subject->id) }}?classroom_id={{ $classroom->id }}"
                       class="border rounded-lg p-4 shadow hover:shadow-lg transition bg-gray-50 hover:bg-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $subject->name }}</h3>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No materials matching your specialization in this classroom.</p>
        @endif
    @else
        <p class="text-gray-500">This classroom has no materials yet.</p>
    @endif
</div>
@endsection
