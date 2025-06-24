<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
<body class="bg-gradient-to-r from-indigo-100 to-blue-200 flex justify-center items-center min-h-screen font-sans">

    <!-- Background Image -->
    <div class="absolute top-0 left-0 w-full h-full bg-cover bg-center" style="background-image: url('https://www.w3schools.com/w3images/school.jpg'); opacity: 0.3;"></div>

    <!-- Login Card -->
    <div class="relative bg-white p-8 rounded-lg shadow-xl w-96 mx-4 sm:mx-0">
        <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800">Login</h2>

        <!-- Display Error Messages -->
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Tabs -->
        <div class="flex mb-6 border-b">
            <button id="email-tab" class="flex-1 py-2 text-center bg-blue-600 text-white rounded-l font-semibold"
                onclick="switchLoginMethod('email')">Email</button>
            <button id="nis-nip-tab" class="flex-1 py-2 text-center bg-gray-200 rounded-r font-semibold"
                onclick="switchLoginMethod('nisn_nip')">NIS / NIP</button>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" id="login_type" name="login_type" value="email">

            <label id="identifier-label" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input id="identifier" type="email" name="identifier" class="w-full border rounded px-4 py-3 mb-6 focus:ring-2 focus:ring-blue-300"
                placeholder="Enter your email" required>

            <label class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" name="password" class="w-full border rounded px-4 py-3 mb-4 focus:ring-2 focus:ring-blue-300"
                placeholder="Enter your password" required>

            <!-- Forgot Password Link -->
            <div class="text-right mb-6">
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline text-sm">Forgot Password?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-md font-semibold hover:bg-blue-700 transition duration-300">Login</button>
        </form>

        <!-- Back to Landing Page Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('welcome') }}" class="text-sm text-gray-600 hover:text-blue-600 underline">
                ← Back to Landing Page
            </a>
        </div>
    </div>

</body>
</html>
