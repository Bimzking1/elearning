<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css') <!-- Tailwind (if using Vite) -->
</head>
<body>
    <div class="container mx-auto p-4">
        @yield('content')  <!-- This is where page content will load -->
    </div>
</body>
</html>
