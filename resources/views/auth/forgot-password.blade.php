<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Forgot Password - Bina Abdi Wiyata</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-100 to-blue-200 min-h-screen flex items-center justify-center font-sans px-4">

    <div class="w-full max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden p-8">

        <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800">Forgot Password</h2>

        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label class="block text-gray-700 font-semibold mb-2">Registered Email</label>
            <input type="email" name="email" required
                   placeholder="Enter your registered email at PKBM"
                   class="w-full border rounded px-4 py-3 mb-6 focus:ring-2 focus:ring-blue-300" />

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-md font-semibold hover:bg-blue-700 transition duration-300">
                Send Reset Link
            </button>
        </form>

        <!-- Back to Login -->
        <div class="mt-6 flex justify-center">
            <a href="{{ route('login') }}"
               class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 transition duration-200">
                <svg class="w-4 h-4 mr-1 mt-1" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Login
            </a>
        </div>

        <!-- Back to Landing Page -->
        <div class="mt-2 flex justify-center">
            <a href="{{ route('welcome') }}"
               class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 transition duration-200">
                <svg class="w-4 h-4 mr-1 mt-1" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Landing Page
            </a>
        </div>
    </div>

</body>
</html>
