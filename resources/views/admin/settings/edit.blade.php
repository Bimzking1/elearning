@extends('layouts.admin.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Admin Settings</h2>

    @if (session('success'))
        <div class="mb-6 px-4 py-3 bg-green-100 text-green-700 rounded-lg border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email', $user->email) }}"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >
            @error('email')
                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
            <input
                type="password"
                name="password"
                id="password"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >
            <p class="text-sm text-gray-500 mt-1">Leave blank to keep your current password.</p>
            @error('password')
                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >
        </div>

        <div class="pt-4">
            <button
                type="submit"
                class="inline-flex items-center justify-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition"
            >
                Update Settings
            </button>
        </div>
    </form>
</div>
@endsection
