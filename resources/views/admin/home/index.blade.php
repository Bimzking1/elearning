@extends('layouts.admin.dashboard')

@section('content')
    <div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold text-gray-800">Home Page</h2>
        <p>Welcome to the Admin Dashboard.</p>
    </div>
    <div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-2xl font-bold mb-4">Informations</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-blue-100 p-4 rounded-lg shadow text-center">
                <p class="text-lg font-semibold">{{ $totalUsers }}</p>
                <p class="text-sm text-gray-700">Total Users</p>
            </div>

            <a href="{{ route('admin.teacher.index') }}" class="bg-green-100 p-4 rounded-lg shadow text-center hover:bg-green-200 transition">
                <p class="text-lg font-semibold">{{ $totalTeachers }}</p>
                <p class="text-sm text-gray-700">Teachers</p>
            </a>

            <a href="{{ route('admin.students.index') }}" class="bg-yellow-100 p-4 rounded-lg shadow text-center hover:bg-yellow-200 transition">
                <p class="text-lg font-semibold">{{ $totalStudents }}</p>
                <p class="text-sm text-gray-700">Students</p>
            </a>

            <a href="{{ route('admin.classrooms.index') }}" class="bg-purple-100 p-4 rounded-lg shadow text-center hover:bg-purple-200 transition">
                <p class="text-lg font-semibold">{{ $totalClassrooms }}</p>
                <p class="text-sm text-gray-700">Classrooms</p>
            </a>
        </div>
    </div>
@endsection
