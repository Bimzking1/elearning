@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.teacher.index') }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <h2 class="text-2xl font-bold my-4">Edit Teacher</h2>

    <form action="{{ route('admin.teacher.update', $user->id) }}" enctype="multipart/form-data" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Photo Section -->
            <div class="flex-shrink-0">
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo</label>

                <div class="mb-2 w-48 aspect-[3/4] bg-gray-100 rounded-md overflow-hidden shadow relative">
                    <img id="photo-preview"
                        src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default-avatar.png') }}"
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

                <!-- Change Password -->
                <div class="w-full">
                    <label for="change_password" class="inline-flex items-center">
                        <input type="checkbox" id="change_password" name="change_password" class="mr-2">
                        <span class="text-sm font-medium text-gray-700">Change Password</span>
                    </label>
                </div>

                <div id="password_section" class="hidden">
                    <div class="w-full">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input placeholder="Input new password" type="password" name="password" id="password"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div id="password_confirmation_section" class="hidden">
                    <div class="w-full">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input placeholder="Retype new password" type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
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
                        <option value="male" {{ isset($user->teacher) && $user->teacher->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ isset($user->teacher) && $user->teacher->gender == 'female' ? 'selected' : '' }}>Female</option>
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
            </div>
        </div>
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
    <script>
        const fileInput = document.getElementById('photo');
        const previewImg = document.getElementById('photo-preview');
        const deleteBtn = document.getElementById('delete-photo-btn');
        const defaultImg = "{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default-avatar.png') }}";

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
