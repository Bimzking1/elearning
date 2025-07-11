@extends('layouts.student.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('student.profile.index') }}"
        class="inline-flex items-center text-sm text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg font-medium transition">
            ← Back
        </a>
    </div>

    <h2 class="text-2xl font-bold mb-6">Edit Profile</h2>

    <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded p-2">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" class="w-full border rounded p-2">
            @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Address</label>
            <input type="text" name="address" value="{{ old('address', $student->address) }}" class="w-full border rounded p-2">
            @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Profile Photo</label>
            <input type="file" name="photo" class="w-full border rounded p-2">
            @error('photo') <span class="text-red-500">{{ $message }}</span> @enderror

            @if($user->photo)
                <img src="{{ assetSubmissionPhoto($user->photo) }}" class="mt-2 w-24 h-24 rounded-full object-cover">
            @endif
        </div>

        <hr class="my-6">

        <h3 class="text-lg font-semibold mb-2">Change Password</h3>
        <div class="mb-4">
            <label class="block font-medium text-gray-700">New Password</label>
            <input type="password" name="password" class="w-full border rounded p-2">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Save Changes</button>
        </div>
    </form>
</div>
@endsection
