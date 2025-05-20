@extends('layouts.student.dashboard')

@section('content')
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Profile</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Profile Photo Section -->
            <div class="flex flex-col items-center justify-center bg-gray-100 p-6 rounded-lg shadow-md">
                <div class="w-36 h-36 xl:w-48 xl:h-48 rounded-full overflow-hidden bg-gray-200 mb-4">
                    <!-- If the user has a profile photo, display it, otherwise show a default avatar -->
                    <img src="{{ $student->user->photo ? asset('storage/' . $student->user->photo) : asset('images/default-avatar.png') }}" alt="Profile Photo" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-semibold text-gray-800 text-center">{{ $user->name }}</h3>
                <p class="text-gray-500">{{ $user->email }}</p>
            </div>

            <!-- Student Details Section -->
            <div class="col-span-1 md:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <div class="space-y-4">
                    <div class="flex flex-col md:flex-row justify-between">
                        <p class="font-semibold text-gray-700">Name:</p>
                        <p class="text-gray-600 md:text-right">{{ $user->name }}</p>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between">
                        <p class="font-semibold text-gray-700">Email:</p>
                        <p class="text-gray-600 md:text-right">{{ $user->email }}</p>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between">
                        <p class="font-semibold text-gray-700">Role:</p>
                        <p class="text-gray-600 md:text-right">{{ ucfirst($user->role) }}</p>
                    </div>

                    <!-- Student-specific fields -->
                    <div class="flex flex-col md:flex-row justify-between">
                        <p class="font-semibold text-gray-700">NISN:</p>
                        <p class="text-gray-600 md:text-right">{{ $student->nisn }}</p>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between">
                        <p class="font-semibold text-gray-700">Date of Birth:</p>
                        <p class="text-gray-600 md:text-right">{{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d M, Y') : 'Not provided' }}</p>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between">
                        <p class="font-semibold text-gray-700">Gender:</p>
                        <p class="text-gray-600 md:text-right">{{ ucfirst($student->gender) }}</p>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between">
                        <p class="font-semibold text-gray-700">Phone:</p>
                        <p class="text-gray-600 md:text-right">{{ $student->phone ?? 'Not provided' }}</p>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between">
                        <p class="font-semibold text-gray-700">Address:</p>
                        <p class="text-gray-600 md:text-right">{{ $student->address ?? 'Not provided' }}</p>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between">
                        <p class="font-semibold text-gray-700">Class:</p>
                        <p class="text-gray-600 md:text-right">{{ $student->classroom->name ?? 'Not assigned' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
