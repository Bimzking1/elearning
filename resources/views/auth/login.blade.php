<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login - Bina Abdi Wiyata</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function switchLoginMethod(method) {
            let label = document.getElementById('identifier-label');
            let input = document.getElementById('identifier');

            if (method === 'email') {
                label.innerText = 'Email';
                input.setAttribute('type', 'email');
                input.setAttribute('placeholder', 'Enter your email');
            } else {
                label.innerText = 'NIS / NIP';
                input.setAttribute('type', 'text');
                input.setAttribute('placeholder', 'Enter your NIS or NIP');
            }

            document.getElementById('login_type').value = method;

            document.getElementById('email-tab').classList.toggle('bg-blue-600', method === 'email');
            document.getElementById('email-tab').classList.toggle('text-white', method === 'email');
            document.getElementById('email-tab').classList.toggle('bg-gray-200', method !== 'email');

            document.getElementById('nis-nip-tab').classList.toggle('bg-blue-600', method === 'nisn_nip');
            document.getElementById('nis-nip-tab').classList.toggle('text-white', method === 'nisn_nip');
            document.getElementById('nis-nip-tab').classList.toggle('bg-gray-200', method !== 'nisn_nip');
        }
    </script>
</head>
<body class="bg-gradient-to-r from-indigo-100 to-blue-200 min-h-screen flex items-center justify-center font-sans px-4 md:px-0">

    <div class="w-full max-w-5xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">

    <!-- Left Side (Image + School Name) -->
    <div class="hidden md:flex md:w-1/2 bg-white flex-col justify-center items-center text-[#262626] p-10">
        <img src="{{ asset('images/login.png') }}" alt="School" class="w-full h-fit object-cover rounded-lg mb-6">

        <!-- School Name + Logo -->
        <div class="flex items-center space-x-3 mb-1">
            <img src="{{ asset('images/baw-500.png') }}" alt="Logo" class="w-8 h-8 object-contain">
            <h2 class="text-3xl font-bold">Bina Abdi Wiyata</h2>
        </div>

        <p class="text-sm mt-2 text-center italic">A Life-improving Centre for Community Learning Activities</p>
    </div>

        <!-- Right Side (Login Form) -->
        <div class="w-full md:w-1/2 p-8">
            <!-- Mobile Logo + Title -->
            <div class="flex items-center justify-center space-x-4 mb-6 md:hidden">
                <img src="{{ asset('images/baw-500.png') }}" alt="Logo" class="w-auto h-10 object-contain">
                <h2 class="text-2xl font-bold text-gray-800">Bina Abdi Wiyata</h2>
            </div>

            <!-- Original title (desktop only, hidden on mobile) -->
            <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800 hidden md:block">Login</h2>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Method Tabs -->
            <div class="flex mb-6 border-b rounded overflow-hidden">
                <button id="email-tab" class="flex-1 py-2 text-center bg-blue-600 text-white font-semibold"
                        onclick="switchLoginMethod('email')">Email</button>
                <button id="nis-nip-tab" class="flex-1 py-2 text-center bg-gray-200 font-semibold"
                        onclick="switchLoginMethod('nisn_nip')">NIS / NIP</button>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" id="login_type" name="login_type" value="email">

                <label id="identifier-label" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input id="identifier" type="email" name="identifier"
                    class="w-full border rounded px-4 py-3 mb-6 focus:ring-2 focus:ring-blue-300"
                    placeholder="Enter your email" required>

                <label class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password"
                    class="w-full border rounded px-4 py-3 mb-4 focus:ring-2 focus:ring-blue-300"
                    placeholder="Enter your password" required>

                <!-- Forgot Password -->
                <div class="flex justify-end mb-6">
                    <a href="{{ route('password.request') }}"
                    class="text-sm font-medium text-gray-600 hover:text-blue-700 transition duration-200">
                        Forgot Password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-md font-semibold hover:bg-blue-700 transition duration-300">
                    Login
                </button>
            </form>

            <!-- Back to Landing -->
            <div class="mt-8 flex justify-center">
                <a href="{{ route('welcome') }}"
                class="inline-flex justify-center items-center text-sm font-medium text-gray-600 hover:text-blue-600 transition duration-200">
                    <svg class="w-4 h-4 mr-1 mt-1" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span>
                        Back to Landing Page
                    </span>
                </a>
            </div>
        </div>
    </div>

</body>
</html>
