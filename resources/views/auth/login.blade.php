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
                label.innerText = 'NISN / NIP';
                input.setAttribute('type', 'text');
                input.setAttribute('placeholder', 'Enter your NISN or NIP');
            }

            document.getElementById('login_type').value = method;

            document.getElementById('email-tab').classList.toggle('bg-blue-600', method === 'email');
            document.getElementById('email-tab').classList.toggle('text-white', method === 'email');
            document.getElementById('email-tab').classList.toggle('bg-gray-200', method !== 'email');

            document.getElementById('nisn-nip-tab').classList.toggle('bg-blue-600', method === 'nisn_nip');
            document.getElementById('nisn-nip-tab').classList.toggle('text-white', method === 'nisn_nip');
            document.getElementById('nisn-nip-tab').classList.toggle('bg-gray-200', method !== 'nisn_nip');
        }
    </script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>

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
        <div class="flex mb-4">
            <button id="email-tab" class="flex-1 py-2 text-center bg-blue-600 text-white rounded-l"
                onclick="switchLoginMethod('email')">Email</button>
            <button id="nisn-nip-tab" class="flex-1 py-2 text-center bg-gray-200 rounded-r"
                onclick="switchLoginMethod('nisn_nip')">NISN / NIP</button>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" id="login_type" name="login_type" value="email">

            <label id="identifier-label" class="block mb-2">Email</label>
            <input id="identifier" type="email" name="identifier" class="w-full border rounded px-3 py-2 mb-4" placeholder="Enter your email" required>

            <label class="block mb-2">Password</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2 mb-2" placeholder="Enter your password" required>

            <!-- Forgot Password Link -->
            <div class="text-right mb-4">
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline text-sm">Forgot Password?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Login</button>
        </form>

        <!-- Back to Landing Page Button -->
        <div class="mt-4 text-center">
            <a href="{{ route('welcome') }}" class="text-sm text-gray-600 hover:text-blue-600 underline">
                ← Back to Landing Page
            </a>
        </div>

    </div>
</body>
</html>
