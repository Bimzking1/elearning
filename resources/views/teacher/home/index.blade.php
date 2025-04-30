@extends('layouts.teacher.dashboard')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    {{-- Welcome Box --}}
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-2">Welcome, {{ auth()->user()->name }} 👩‍🏫</h2>
        <p class="text-gray-600 text-base">You're logged in as a teacher. Stay updated with the latest announcements and manage your classes with ease.</p>
    </div>

    {{-- Announcements --}}
    @isset($announcements)
        @if ($announcements->count() > 0)
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">📢 Recent Announcements</h3>

                <div class="space-y-6">
                    @foreach ($announcements as $announcement)
                        <div class="p-5 bg-gray-50 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                            <h4 class="text-xl font-semibold text-blue-700 mb-1">{{ $announcement->title }}</h4>
                            <p class="text-gray-700 mb-2">{{ $announcement->content }}</p>

                            <div class="text-sm text-gray-500 mb-2">
                                📅
                                {{ \Carbon\Carbon::parse($announcement->start_date)->format('M d, Y H:i') }}
                                @if($announcement->end_date)
                                    — {{ \Carbon\Carbon::parse($announcement->end_date)->format('M d, Y H:i') }}
                                @endif
                            </div>

                            @if($announcement->attachment)
                                @php $fileUrl = Storage::url($announcement->attachment); @endphp
                                <a href="{{ $fileUrl }}" target="_blank" class="inline-block mt-2 text-sm text-blue-600 hover:underline font-medium">
                                    📎 View Attachment
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $announcements->links('pagination::tailwind') }}
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-md p-6 mt-6 text-gray-600">
                <p class="text-center">There are no announcements at the moment. Please check back later.</p>
            </div>
        @endif
    @endisset
</div>
@endsection
