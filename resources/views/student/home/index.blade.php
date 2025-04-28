@extends('layouts.student.dashboard')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800">Home Page</h2>
        <p>Welcome to the Student Dashboard.</p>
    </div>

    @isset($announcements)
        @if ($announcements->count() > 0)
            <div class="mt-6 max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Announcements</h3>
                @foreach ($announcements as $announcement)
                    <div class="mb-4 p-4 border border-gray-300 rounded-lg">
                        <h4 class="text-lg font-bold text-blue-600">{{ $announcement->title }}</h4>
                        <p class="text-gray-700">{{ $announcement->content }}</p>
                        <p class="text-sm text-gray-500 mt-2">
                            📅 {{ \Carbon\Carbon::parse($announcement->start_date)->format('M d, Y H:i') }}
                            @if($announcement->end_date)
                                - {{ \Carbon\Carbon::parse($announcement->end_date)->format('M d, Y H:i') }}
                            @endif
                        </p>

                        {{-- File Previewer --}}
                        @if($announcement->attachment)
                            <div>
                                @php
                                    $fileUrl = Storage::url($announcement->attachment);
                                @endphp

                                <a href="{{ $fileUrl }}" target="_blank" class="text-blue-600 font-medium italic">
                                    📎 View Attachment File
                                </a>
                            </div>
                        @endif

                    </div>
                @endforeach

                <div class="mt-4">
                    {{ $announcements->links() }}
                </div>
            </div>
        @endif
    @else
        <div class="mt-6 max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <p>No announcements available.</p>
        </div>
    @endisset
@endsection

