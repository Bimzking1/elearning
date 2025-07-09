@extends('layouts.student.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 md:p-8 rounded-2xl shadow-md space-y-6">

    {{-- Header --}}
    <div>
        <a href="{{ route('student.materials.bySubject', ['subject' => $subject->id]) }}"
           class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium shadow transition">
            ← Back to Materials
        </a>
    </div>

    {{-- Title --}}
    <div>
        <h2 class="text-3xl font-bold text-gray-900">{{ $material->name }}</h2>
        <p class="mt-1 text-sm text-gray-500">Created on {{ $material->created_at->format('F j, Y') }}</p>
    </div>

    {{-- Subject & Classroom Info --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <div>
            <span class="text-gray-500">Subject:</span>
            <p class="font-medium text-gray-800">{{ $subject->name }}</p>
        </div>
        <div>
            <span class="text-gray-500">Classroom:</span>
            <p class="font-medium text-gray-800">{{ $classroom->name }}</p>
        </div>
    </div>

    {{-- Description --}}
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-1">📄 Description</h3>
        <p class="text-gray-700 whitespace-pre-line">{{ $material->description ?? '—' }}</p>
    </div>

    {{-- File --}}
    @if($material->file_path)
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-1">Attached File</h3>
        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank"
           class="text-blue-600 underline hover:text-blue-800 text-sm">
            View / Download File
        </a>
    </div>
    @endif

    {{-- Links --}}
    @if(!empty($material->link_urls))
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">🔗 External Links</h3>
        <ul class="space-y-1 text-sm text-blue-600">
            @foreach($material->link_urls as $url)
                <li>
                    <a href="{{ $url }}" target="_blank" class="underline hover:text-blue-800">{{ $url }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    @endif

</div>
@endsection
