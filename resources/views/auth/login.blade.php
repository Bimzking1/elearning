<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label class="block mb-2">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2 mb-4" required>

            <label class="block mb-2">Password</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2 mb-4" required>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Login</button>
        </form>
    </div>
</body>
</html>
