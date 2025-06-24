@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
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

    <form action="{{ route('admin.students.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Photo Section -->
            <div class="flex-shrink-0">
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo</label>

                <div class="mb-2 w-48 aspect-[3/4] bg-gray-100 rounded-md overflow-hidden shadow relative">
                    <img id="photo-preview" src="{{ asset('images/default-avatar.png') }}" alt="Photo Preview"
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
                <!-- Name -->
                <div class="w-full">
                    <label for="name" class="block text-sm font-medium text-gray-700">Student Name</label>
                    <input placeholder="Input Student Name" type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
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

                <!-- NIS -->
                <div class="w-full">
                    <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                    <input placeholder="Input NIS" type="text" name="nis" id="nis" value="{{ old('nis') }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    @error('nis')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Classroom -->
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

                <!-- Phone -->
                <div class="w-full">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input placeholder="Input Phone Number" type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    @error('phone')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Guardian Information -->
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

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md shadow-md hover:bg-blue-700 transition disabled:bg-gray-400"
                        {{ $classrooms->isEmpty() ? 'disabled' : '' }}>
                    Create Student
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        const fileInput = document.getElementById('photo');
        const previewImg = document.getElementById('photo-preview');
        const deleteBtn = document.getElementById('delete-photo-btn');
        const defaultImg = "{{ asset('images/default-avatar.png') }}";  // Default image for new student

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
            deleteBtn.classList.add('hidden'); // Hide the button again
        });
    </script>
@endpush
@endsection
