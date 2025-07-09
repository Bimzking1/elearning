@extends('layouts.teacher.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('teacher.materials.byClassroom') }}?classroom_id={{ $classroom->id }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back to Subjects
        </a>
    </div>

    <div class="flex justify-between items-center mt-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Materials for {{ $subject->name }} in {{ $classroom->name }}</h2>
        <a href="{{ route('teacher.materials.create') }}?classroom_id={{ $classroom->id }}&subject_id={{ $subject->id }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add Material
        </a>
    </div>

    @if($materials->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($materials as $material)
                <div class="border rounded-lg p-4 bg-gray-50 hover:bg-gray-100 shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $material->name }}</h3>
                    <p class="text-sm text-gray-600 mb-3">{{ $material->description }}</p>

                    <div class="flex gap-2">
                        <a href="{{ route('teacher.materials.view', $material->id) }}"
                           class="text-sm bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded">
                            View
                        </a>
                        <a href="{{ route('teacher.materials.edit', $material->id) }}"
                           class="text-sm bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                            Edit
                        </a>
                        <form action="{{ route('teacher.materials.destroy', $material->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this material?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-sm bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">No materials found for this subject in this classroom.</p>
    @endif
</div>
@endsection
