@extends('layouts.teacher.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    {{-- Back Button --}}
    <div>
        <a href="{{ route('teacher.materials.byClassroom') }}?classroom_id={{ $classroom->id }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back to Subjects
        </a>
    </div>

    {{-- Header & Add --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mt-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Materials for {{ $subject->name }} in {{ $classroom->name }}</h2>
        <a href="{{ route('teacher.materials.create') }}?classroom_id={{ $classroom->id }}&subject_id={{ $subject->id }}"
           class="w-full md:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Add Material
        </a>
    </div>

    {{-- Search & View Toggle --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-4">
        <form method="GET" action="{{ route('teacher.materials.bySubject', ['subject' => $subject->id]) }}" class="flex gap-2 w-full md:w-auto items-center">
            <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
            <input type="hidden" name="view" value="{{ request('view', 'card') }}">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search material name"
                   class="w-full md:w-64 border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-300">

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                Search
            </button>

            @if(request('search'))
                <a href="{{ route('teacher.materials.bySubject', ['subject' => $subject->id]) }}?classroom_id={{ $classroom->id }}&view={{ request('view', 'card') }}"
                   class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 transition">
                    Clear Search
                </a>
            @endif
        </form>

        {{-- View Toggle --}}
        <div class="flex gap-2">
            <a href="{{ route('teacher.materials.bySubject', ['subject' => $subject->id]) }}?classroom_id={{ $classroom->id }}&view=card"
               class="px-4 py-2 rounded font-semibold transition
               {{ request('view', 'card') === 'card' ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200' }}">
                Card View
            </a>

            <a href="{{ route('teacher.materials.bySubject', ['subject' => $subject->id]) }}?classroom_id={{ $classroom->id }}&view=list"
               class="px-4 py-2 rounded font-semibold transition
               {{ request('view') === 'list' ? 'bg-green-600 text-white' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                List View
            </a>
        </div>
    </div>

    {{-- CARD VIEW --}}
    @if(request('view', 'card') === 'card')
        @if($materials->isEmpty())
            <p class="text-gray-500">No materials found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($materials as $material)
                    <div class="border rounded-lg p-4 bg-gray-50 hover:bg-gray-100 shadow hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $material->name }}</h3>
                        <p class="text-sm text-gray-600 mb-3">{{ $material->description }}</p>

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

                        <div class="flex gap-2 mt-4">
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
        @endif

    {{-- LIST VIEW --}}
    @else
        @php
            function sortLink($label, $column, $sort, $direction) {
                $isSorted = $sort === $column;
                $newDirection = ($isSorted && $direction === 'asc') ? 'desc' : 'asc';
                $arrow = $isSorted ? ($direction === 'asc' ? '↑' : '↓') : '';
                $url = request()->fullUrlWithQuery(['sort' => $column, 'direction' => $newDirection, 'view' => 'list']);
                return '<a href="'.$url.'" class="hover:underline">'.$label.' '.$arrow.'</a>';
            }
        @endphp

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full table-auto border border-gray-300 text-sm bg-white shadow-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left w-10">#</th>
                        <th class="px-4 py-3 text-left max-w-[200px]">{!! sortLink('Name', 'name', $sort, $direction) !!}</th>
                        <th class="px-4 py-3 text-left max-w-[200px]">Description</th>
                        <th class="px-4 py-3 text-left">{!! sortLink('Created At', 'created_at', $sort, $direction) !!}</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @forelse ($materials as $index => $material)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ ($materials->currentPage() - 1) * $materials->perPage() + $index + 1 }}</td>
                            <td class="px-4 py-2 font-semibold max-w-[200px] truncate" title="{{ $material->name }}">
                                {{ $material->name }}
                            </td>
                            <td class="px-4 py-2 max-w-[200px] truncate" title="{{ $material->description }}">
                                {{ \Illuminate\Support\Str::limit($material->description, 100) }}
                            </td>
                            <td class="px-4 py-2">{{ $material->created_at->format('D, M j Y') }}</td>
                            <td class="px-4 py-2">
                                <div class="flex gap-2">
                                    <a href="{{ route('teacher.materials.view', $material->id) }}"
                                       class="text-sm text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded-md">View</a>
                                    <a href="{{ route('teacher.materials.edit', $material->id) }}"
                                       class="text-sm text-white bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded-md">Edit</a>
                                    <form action="{{ route('teacher.materials.destroy', $material->id) }}" method="POST"
                                          onsubmit="return confirm('Delete this material?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-sm text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">No materials found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $materials->links() }}
    </div>
</div>
@endsection
