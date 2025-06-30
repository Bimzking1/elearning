@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.students.index') }}"
           class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <h2 class="text-2xl font-bold my-4">Edit Student</h2>

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

    <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Photo Section -->
            <div class="flex-shrink-0">
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo</label>

                <div class="mb-2 w-48 aspect-[3/4] bg-gray-100 rounded-md overflow-hidden shadow relative">
                    <img id="photo-preview"
                        src="{{ $student->user->photo ? asset('storage/' . $student->user->photo) : asset('images/default-avatar.png') }}"
                        alt="Photo Preview"
                        class="w-full h-full object-cover absolute inset-0">
                </div>

                <input type="file" name="photo" id="photo" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                <button type="button"
                    id="delete-photo-btn"
                    class="mt-2 w-full px-4 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-md hidden">
                    Hapus Foto
                </button>

            </div>

            <!-- Form Fields -->
            <div class="flex-grow space-y-4">
                <!-- Name (Read-Only) -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700">Student Name</label>
                    <input placeholder="Input Student Name" name="name" type="text" value="{{ $student->user->name }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
                </div>

                <!-- Email (Read-Only) -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input placeholder="Input Email" name="email" type="email" value="{{ $student->user->email }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
                </div>

                <!-- Checkbox to Change Password -->
                <div class="w-full">
                    <input type="checkbox" id="change_password_checkbox" class="mr-2">
                    <label for="change_password_checkbox" class="text-sm font-medium text-gray-700">
                        Change Password
                    </label>
                </div>

                <!-- Password (Hidden by Default) -->
                <div id="password_fields" class="hidden">
                    <div class="w-full mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input placeholder="Input New Password" type="password" name="password" id="password"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Confirm Password -->
                    <div class="w-full">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input placeholder="Retype New Password" type="password" name="password_confirmation" id="password_confirmation"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <!-- NIS -->
                <div class="w-full">
                    <label for="nis" class="block text-sm font-medium text-gray-700">Student ID Number (NIS)</label>
                    <input placeholder="Input NIS" type="text" name="nis" id="nis" value="{{ $student->nis }}" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- NISN -->
                <div class="w-full">
                    <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                    <input placeholder="Input NISN" type="text" name="nisn" id="nisn" value="{{ $student->nisn }}" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Date of Birth -->
                <div class="w-full">
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input placeholder="Input Date of Birth" type="date" name="date_of_birth" id="date_of_birth" value="{{ $student->date_of_birth }}" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Gender -->
                <div class="w-full">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" id="gender" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <!-- Classroom -->
                <div class="w-full">
                    <label for="classroom_id" class="block text-sm font-medium text-gray-700">Classroom</label>
                    <select name="classroom_id" id="classroom_id" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        <option value="" disabled>Select Classroom</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ $student->classroom_id == $classroom->id ? 'selected' : '' }}>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Address -->
                <div class="w-full">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input placeholder="Input Address" type="text" name="address" id="address" value="{{ $student->address }}" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Phone -->
                <div class="w-full">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input placeholder="Input Phone Number" type="text" name="phone" id="phone" value="{{ $student->phone }}" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Guardian Name -->
                <div class="w-full">
                    <label for="guardian_name" class="block text-sm font-medium text-gray-700">Guardian Name</label>
                    <input placeholder="Input Guardian Name" type="text" name="guardian_name" id="guardian_name" value="{{ $student->guardian_name }}" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Guardian Phone -->
                <div class="w-full">
                    <label for="guardian_phone" class="block text-sm font-medium text-gray-700">Guardian Phone</label>
                    <input placeholder="Input Guardian Phone Number" type="text" name="guardian_phone" id="guardian_phone" value="{{ $student->guardian_phone }}" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-md shadow-md hover:bg-blue-700 transition">
                    Update Student
                </button>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript to Toggle Password Fields and Handle Photo Upload -->
<script>
    document.getElementById('change_password_checkbox').addEventListener('change', function() {
        document.getElementById('password_fields').classList.toggle('hidden', !this.checked);
    });

    // Photo Upload and Delete Script
    const fileInput = document.getElementById('photo');
    const previewImg = document.getElementById('photo-preview');
    const deleteBtn = document.getElementById('delete-photo-btn');
    const defaultImg = "{{ $student->photo ? asset('storage/' . $student->photo) : asset('images/default-avatar.png') }}";

    fileInput.addEventListener('change', function (event) {
        const [file] = event.target.files;
        if (file) {
            previewImg.src = URL.createObjectURL(file);
            deleteBtn.classList.remove('hidden');
        }
    });

    deleteBtn.addEventListener('click', function () {
        fileInput.value = ''; // Clear selected file
        previewImg.src = defaultImg; // Reset preview
        deleteBtn.classList.add('hidden'); // Hide the delete button
    });
</script>

@endsection
