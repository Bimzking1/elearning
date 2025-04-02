@extends('layouts.dashboard')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.teacher.index') }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <h2 class="text-2xl font-bold my-4">Edit Teacher</h2>

    <form action="{{ route('admin.teacher.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="w-full">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input placeholder="Input full name" type="text" name="name" id="name" value="{{ $user->name }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Email -->
        <div class="w-full">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input placeholder="Input email" type="email" name="email" id="email" value="{{ $user->email }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Password Change Checkbox -->
        <div class="w-full">
            <label for="change_password" class="inline-flex items-center">
                <input type="checkbox" id="change_password" name="change_password" class="mr-2">
                <span class="text-sm font-medium text-gray-700">Change Password</span>
            </label>
        </div>

        <!-- New Password (appears if checkbox is checked) -->
        <div class="w-full" id="password_section" style="display: none;">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input placeholder="Input new password" type="password" name="password" id="password"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Retype Password (appears if checkbox is checked) -->
        <div class="w-full" id="password_confirmation_section" style="display: none;">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input placeholder="Retype new password" type="password" name="password_confirmation" id="password_confirmation"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- NIP -->
        <div class="w-full">
            <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
            <input placeholder="Input NIP" type="text" name="nip" id="nip" value="{{ $user->teacher->nip ?? '' }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Specialization -->
        <div class="w-full">
            <label for="specialization" class="block text-sm font-medium text-gray-700">Specialization</label>
            <input placeholder="Input specialization" type="text" name="specialization" id="specialization"
                value="{{ $user->teacher->specialization ?? '' }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Gender -->
        <div class="w-full">
            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select name="gender" id="gender" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled selected>Select Gender</option>
                <option value="male" {{ $user->teacher->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $user->teacher->gender == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <!-- Address -->
        <div class="w-full">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input placeholder="Input Address" type="text" name="address" id="address" value="{{ $user->teacher->address ?? '' }}"
                required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Phone -->
        <div class="w-full">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input placeholder="Input Phone Number" type="number" name="phone" id="phone" value="{{ $user->teacher->phone ?? '' }}"
                required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Date of Birth -->
        <div class="w-full">
            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input placeholder="Input Date of Birth" type="date" name="date_of_birth" id="date_of_birth"
                value="{{ $user->teacher->date_of_birth ?? '' }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Joined Date -->
        <div class="w-full">
            <label for="joined_date" class="block text-sm font-medium text-gray-700">Joined Date</label>
            <input placeholder="Input join date" type="date" name="joined_date" id="joined_date"
                value="{{ $user->teacher->joined_date ?? '' }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-md shadow-md hover:bg-blue-700 transition">
            Update Teacher
        </button>
    </form>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordCheckbox = document.getElementById('change_password');
            const passwordSection = document.getElementById('password_section');
            const passwordConfirmationSection = document.getElementById('password_confirmation_section');

            passwordCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    passwordSection.style.display = 'block';
                    passwordConfirmationSection.style.display = 'block';
                } else {
                    passwordSection.style.display = 'none';
                    passwordConfirmationSection.style.display = 'none';
                }
            });
        });
    </script>
@endpush

@endsection
