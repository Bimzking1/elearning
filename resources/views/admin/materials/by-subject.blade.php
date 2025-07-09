@extends('layouts.admin.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.materials.byClassroom') }}?classroom_id={{ $classroom->id }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back to Subjects
        </a>
    </div>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Materials for {{ $subject->name }} in {{ $classroom->name }}</h2>
        <a href="{{ route('admin.materials.create') }}?classroom_id={{ $classroom->id }}&subject_id={{ $subject->id }}"
           class="w-full md:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add Material
        </a>
    </div>

    @if($materials->isEmpty())
        <p class="text-gray-500">No materials available for this subject in this classroom yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($materials as $material)
                <div class="border rounded-lg p-4 shadow bg-gray-50 hover:bg-gray-100 transition">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $material->name }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $material->description }}</p>

                    @if($material->file_path)
                        <p class="text-sm text-blue-600 mb-1">
                            <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="underline">View File</a>
                        </p>
                    @endif

                    @if(!empty($material->link_urls))
                        <ul class="text-sm list-disc list-inside text-blue-600">
                            @foreach($material->link_urls as $url)
                                <li><a href="{{ $url }}" target="_blank" class="underline">{{ $url }}</a></li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('admin.materials.view', $material->id) }}"
                           class="text-sm text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded-md">View</a>
                        <a href="{{ route('admin.materials.edit', $material->id) }}"
                           class="text-sm text-white bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded-md">Edit</a>
                        <form action="{{ route('admin.materials.destroy', $material->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this material?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-sm text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
