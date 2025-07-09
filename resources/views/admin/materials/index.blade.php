@extends('layouts.admin.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Manage Materials</h2>
        <a href="{{ route('admin.materials.create') }}"
           class="w-full md:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add New Material
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($classrooms as $classroom)
            <a href="{{ route('admin.materials.byClassroom') }}?classroom_id={{ $classroom->id }}"
               class="border rounded-lg p-4 shadow hover:shadow-lg transition cursor-pointer bg-gray-50 hover:bg-gray-100">
                <h3 class="text-lg font-semibold text-gray-800">{{ $classroom->name }}</h3>
            </a>
        @endforeach
    </div>
</div>
@endsection
