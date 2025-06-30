@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.teacher.index') }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <h2 class="text-2xl font-bold my-4">Create Teacher</h2>

    <form action="{{ route('admin.teacher.store') }}" enctype="multipart/form-data" method="POST" class="space-y-6">
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
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input placeholder="Input full name" type="text" name="name" id="name" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Email -->
                <div class="w-full">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input placeholder="Input email" type="email" name="email" id="email" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Password -->
                <div class="w-full">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input placeholder="Input password" type="password" name="password" id="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Retype Password -->
                <div class="w-full">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input placeholder="Retype password" type="password" name="password_confirmation" id="password_confirmation" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- NIP -->
                <div class="w-full">
                    <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                    <input placeholder="Input NIP" type="text" name="nip" id="nip" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Specialization -->
                <div class="w-full">
                    <label for="specialization" class="block text-sm font-medium text-gray-700">Specializations</label>

                    @if ($subjects->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2" id="specialization-group">
                            @foreach ($subjects as $subject)
                                <label class="flex items-center space-x-2">
                                    <input
                                        type="checkbox"
                                        name="specialization[]"
                                        value="{{ $subject->name }}"
                                        class="specialization-checkbox text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                        {{ in_array($subject->name, old('specialization', [])) ? 'checked' : '' }}
                                    >
                                    <span class="text-sm text-gray-700">{{ $subject->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p id="specialization-error" class="text-sm text-red-500 hidden mt-1">Please select at least one specialization.</p>
                    @else
                        <div class="mt-1 p-3 bg-yellow-100 border border-yellow-300 rounded-md text-sm text-yellow-800">
                            ⚠ No subjects available. Please
                            <a href="{{ route('admin.subjects.create') }}" class="text-blue-600 underline">create some subjects</a>
                            first.
                        </div>
                    @endif
                </div>

                <!-- Gender -->
                <div class="w-full">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" id="gender" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <!-- Address -->
                <div class="w-full">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input placeholder="Input Address" type="text" name="address" id="address" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Phone -->
                <div class="w-full">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input placeholder="Input Phone Number" type="number" name="phone" id="phone" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Date of Birth -->
                <div class="w-full">
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input placeholder="Input Date of Birth" type="date" name="date_of_birth" id="date_of_birth" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Joined Date -->
                <div class="w-full">
                    <label for="joined_date" class="block text-sm font-medium text-gray-700">Joined Date</label>
                    <input placeholder="Input join date" type="date" name="joined_date" id="joined_date" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <button
                    type="submit"
                    id="submit-button"
                    class="w-full bg-blue-600 text-white py-2 rounded-md shadow-md hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
                    @if ($subjects->isEmpty()) disabled @endif>
                    Create Teacher
                </button>

                @if ($subjects->isEmpty())
                    <p class="text-sm text-red-500 mb-2">⚠ Please add at least one subject before creating a teacher.</p>
                @endif

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
        const defaultImg = "{{ asset('images/default-avatar.png') }}";  // No need for $user here, as this is for creating a new teacher.

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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.specialization-checkbox');
            const submitButton = document.getElementById('submit-button');

            function updateButtonState() {
                const isChecked = Array.from(checkboxes).some(cb => cb.checked);
                submitButton.disabled = !isChecked;
            }

            // Initial check on load
            updateButtonState();

            checkboxes.forEach(cb => {
                cb.addEventListener('change', updateButtonState);
            });
        });
    </script>

@endpush
@endsection

