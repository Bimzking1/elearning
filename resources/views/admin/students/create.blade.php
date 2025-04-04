@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.students.index') }}"
           class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <h2 class="text-2xl font-bold my-4">Create Student</h2>

    @if($classrooms->isEmpty())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded-md">
            ⚠️ You must create at least one classroom before adding students.
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded-md">
            <strong>Oops! Something went wrong:</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.students.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="w-full">
            <label for="name" class="block text-sm font-medium text-gray-700">Student Name</label>
            <input placeholder="Input Student Name" type="text" name="name" id="name" value="{{ old('name') }}" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                   focus:ring-blue-500 focus:border-blue-500">
            @error('name')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="w-full">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input placeholder="Input Email" type="email" name="email" id="email" value="{{ old('email') }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('email')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="w-full">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input placeholder="Input Password" type="password" name="password" id="password" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('password')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="w-full">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input placeholder="Retype Password" type="password" name="password_confirmation" id="password_confirmation" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
        </div>

        <div class="w-full">
            <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
            <input placeholder="Input NISN" type="text" name="nisn" id="nisn" value="{{ old('nisn') }}" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('nisn')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full">
            <label for="classroom_id" class="block text-sm font-medium text-gray-700">Classroom</label>
            <select name="classroom_id" id="classroom_id" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    {{ $classrooms->isEmpty() ? 'disabled' : '' }}>
                <option value="" disabled selected>Select a Classroom</option>
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
            @error('classroom_id')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input placeholder="Input Phone Number" type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('phone')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Address -->
        <div class="w-full">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input placeholder="Input Address" type="text" name="address" id="address" value="{{ old('address') }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('address')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Gender -->
        <div class="w-full">
            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select name="gender" id="gender" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                <option value="" disabled {{ old('gender') === null ? 'selected' : '' }}>Select Gender</option>
                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date of Birth -->
        <div class="w-full">
            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input placeholder="Input Date of Birth" type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('date_of_birth')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full">
            <label for="guardian_name" class="block text-sm font-medium text-gray-700">Guardian Name</label>
            <input placeholder="Input Guardian Name" type="text" name="guardian_name" id="guardian_name" value="{{ old('guardian_name') }}" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('guardian_name')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full">
            <label for="guardian_phone" class="block text-sm font-medium text-gray-700">Guardian Phone</label>
            <input placeholder="Input Guardian Number" type="text" name="guardian_phone" id="guardian_phone" value="{{ old('guardian_phone') }}" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            @error('guardian_phone')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md shadow-md
                hover:bg-blue-700 transition disabled:bg-gray-400"
                {{ $classrooms->isEmpty() ? 'disabled' : '' }}>
            Create Student
        </button>
    </form>
</div>
@endsection
