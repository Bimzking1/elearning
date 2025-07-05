@extends('layouts.student.dashboard')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white rounded-2xl shadow-md space-y-6">

    {{-- Back Button --}}
    <div>
        <a href="{{ route('student.materials.index') }}"
            class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium shadow transition">
            ← Back to Subjects
        </a>
    </div>

    {{-- Subject Title --}}
    <h2 class="text-2xl font-bold text-gray-800">{{ $subject->name }} Materials</h2>

    {{-- Materials List --}}
    @if($materials->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($materials as $material)
                <a href="{{ route('student.materials.view', $material->id) }}"
                   class="block group p-5 rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-200 hover:border-gray-300 shadow-sm hover:shadow transition-all duration-200">
                    <h3 class="text-lg font-semibold text-blue-700 group-hover:underline">{{ $material->name }}</h3>
                    <p class="text-sm text-gray-600 mt-1 line-clamp-3">{{ $material->description }}</p>
                </a>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">No materials available for this subject.</p>
    @endif
</div>
@endsection
