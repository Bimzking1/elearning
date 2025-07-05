@extends('layouts.student.dashboard')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Class Materials</h2>

    @if($subjects->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($subjects as $subject)
                <a href="{{ route('student.materials.bySubject', $subject->id) }}"
                   class="block p-4 bg-gray-100 hover:bg-gray-200 rounded-lg shadow transition">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $subject->name }}</h3>
                    <p class="text-sm text-gray-600">View materials for this subject</p>
                </a>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">No subjects or materials found for your class.</p>
    @endif
</div>
@endsection
