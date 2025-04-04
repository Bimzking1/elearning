@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.announcements.index') }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <h2 class="text-2xl font-bold my-4">Edit Announcement</h2>

    <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="w-full">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title" value="{{ $announcement->title }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Content -->
        <div class="w-full">
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea name="content" id="content" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $announcement->content }}</textarea>
        </div>

        <!-- Roles -->
        <div class="w-full">
            <label for="roles" class="block text-sm font-medium text-gray-700">Audience</label>
            <div class="flex space-x-4">
                <div>
                    <input type="checkbox" name="roles[]" value="teacher" id="role_teacher" class="mr-2"
                        @if(in_array('teacher', $announcement->roles)) checked @endif>
                    <label for="role_teacher" class="text-sm">Teacher</label>
                </div>
                <div>
                    <input type="checkbox" name="roles[]" value="student" id="role_student" class="mr-2"
                        @if(in_array('student', $announcement->roles)) checked @endif>
                    <label for="role_student" class="text-sm">Student</label>
                </div>
                <div>
                    <input type="checkbox" name="roles[]" value="staff" id="role_staff" class="mr-2"
                        @if(in_array('staff', $announcement->roles)) checked @endif>
                    <label for="role_staff" class="text-sm">Staff</label>
                </div>
                <div>
                    <input type="checkbox" name="roles[]" value="all" id="role_all" class="mr-2"
                        @if(in_array('all', $announcement->roles)) checked @endif>
                    <label for="role_all" class="text-sm">All</label>
                </div>
            </div>
        </div>

        <!-- Start Date -->
        <div class="w-full">
            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="datetime-local" name="start_date" id="start_date" required
                value="{{ \Carbon\Carbon::parse($announcement->start_date)->format('Y-m-d\TH:i') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- End Date -->
        <div class="w-full">
            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
            <input type="datetime-local" name="end_date" id="end_date"
                value="{{ $announcement->end_date ? \Carbon\Carbon::parse($announcement->end_date)->format('Y-m-d\TH:i') : '' }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Attachment -->
        <div class="w-full">
            <label for="attachment" class="block text-sm font-medium text-gray-700">Attachment</label>
            <input type="file" name="attachment" id="attachment" accept="image/*, .pdf, .docx, .txt"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @if($announcement->attachment)
                <div class="mt-4">
                    <a class="italic text-blue-600" href="{{ asset('storage/' . $announcement->attachment) }}" target="_blank">Click to view attachment file or image</a>
                </div>
            @endif
        </div>

        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-md shadow-md hover:bg-blue-700 transition">
            Update Announcement
        </button>
    </form>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleAllCheckbox = document.getElementById('role_all');
            const roleTeacherCheckbox = document.getElementById('role_teacher');
            const roleStudentCheckbox = document.getElementById('role_student');
            const roleStaffCheckbox = document.getElementById('role_staff');

            roleAllCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    roleTeacherCheckbox.checked = false;
                    roleStudentCheckbox.checked = false;
                    roleStaffCheckbox.checked = false;
                }
            });

            [roleTeacherCheckbox, roleStudentCheckbox, roleStaffCheckbox].forEach(role => {
                role.addEventListener('change', function() {
                    if (this.checked) {
                        roleAllCheckbox.checked = false;
                    }
                });
            });
        });
    </script>
@endpush

@endsection
