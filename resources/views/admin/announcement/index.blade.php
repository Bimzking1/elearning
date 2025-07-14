@extends('layouts.admin.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Manage Announcements</h2>
        <a href="{{ route('admin.announcements.create') }}"
           class="w-full md:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            + Create New Announcement
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" class="mb-4 flex flex-col md:flex-row gap-2 items-center max-w-md">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title"
            class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-300">

        <div class="flex gap-2">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                Search
            </button>

            @if(request('search'))
                <a href="{{ url()->current() }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 transition">
                    Clear Search
                </a>
            @endif
        </div>
    </form>

    <div class="overflow-x-auto">
        @php
            function sortLink($label, $column, $sort, $direction) {
                $isSorted = $sort === $column;
                $newDirection = ($isSorted && $direction === 'asc') ? 'desc' : 'asc';
                $arrow = $isSorted ? ($direction === 'asc' ? '↑' : '↓') : '';
                $url = request()->fullUrlWithQuery(['sort' => $column, 'direction' => $newDirection]);
                return '<a href="'.$url.'" class="hover:underline">'.$label.' '.$arrow.'</a>';
            }
        @endphp

        <table class="w-full bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">{!! sortLink('#', 'id', $sort, $direction) !!}</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">{!! sortLink('Title', 'title', $sort, $direction) !!}</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">{!! sortLink('Start Date', 'start_date', $sort, $direction) !!}</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">{!! sortLink('End Date', 'end_date', $sort, $direction) !!}</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Roles</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($announcements as $announcement)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $announcement->id }}</td>
                        <td class="px-6 py-4 max-w-[400px] truncate text-sm font-medium text-gray-900">{{ $announcement->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $announcement->start_date ?? 'No start date' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $announcement->end_date ?? 'No expiry' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <div class="flex flex-wrap gap-2">
                                @foreach ($announcement->roles as $role)
                                    <span class="bg-gray-200 rounded-full px-2 py-1 text-sm text-gray-800">{{ ucfirst($role) }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.announcements.edit', $announcement) }}"
                                   class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded-md text-sm shadow-md transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this announcement?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded-md text-sm shadow-md transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No announcements found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $announcements->links() }}
    </div>
</div>
@endsection
