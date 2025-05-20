@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Add New Subject</h2>

    <form action="{{ route('admin.subjects.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Subject Name</label>
            <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" class="w-full p-2 border border-gray-300 rounded-md"></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Save Subject</button>
    </form>
</div>
@endsection
