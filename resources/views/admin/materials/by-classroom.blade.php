@extends('layouts.admin.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.materials.index') }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mt-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Subjects in {{ $classroom->name }}</h2>
        <a href="{{ route('admin.materials.create') }}?classroom_id={{ $classroom->id }}"
           class="w-full md:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add New Material
        </a>
    </div>

    @if($subjects->isEmpty())
        <p class="text-gray-500">No materials available for this classroom yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($subjects as $subject)
                <a href="{{ route('admin.materials.bySubject', ['subject' => $subject->id]) }}?classroom_id={{ $classroom->id }}" class="border rounded-lg p-4 shadow hover:shadow-lg transition cursor-pointer bg-gray-50 hover:bg-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $subject->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $subject->description }}</p>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
