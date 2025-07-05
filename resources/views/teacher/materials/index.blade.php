@extends('layouts.teacher.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">My Materials</h2>
        <a href="{{ route('teacher.materials.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add New Material
        </a>
    </div>

    @if($classrooms->count())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($classrooms as $classroom)
                <a href="{{ route('teacher.materials.byClassroom') }}?classroom_id={{ $classroom->id }}"
                   class="border rounded-lg p-4 shadow hover:shadow-lg transition cursor-pointer bg-gray-50 hover:bg-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $classroom->name }}</h3>
                </a>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">No classrooms assigned to you.</p>
    @endif
</div>
@endsection
