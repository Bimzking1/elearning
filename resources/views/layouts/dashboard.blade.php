<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex w-full">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full bg-blue-600 text-white p-4 md:hidden flex justify-between items-center">
        <h2 class="text-xl font-bold">Dashboard</h2>
        <button id="menuToggle" class="bg-white text-blue-600 p-2 rounded-md">
            ☰
        </button>
    </nav>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-blue-600 min-h-screen text-white p-4 fixed md:relative md:translate-x-0 transition-transform duration-300 -translate-x-full z-10">
        <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
        <ul>
            <li class="mb-2"><a href="#" class="block py-2 page-link" data-page="home">Home</a></li>
            <li class="mb-2"><a href="#" class="block py-2 page-link" data-page="teacher">Teacher</a></li>
            <li class="mb-2"><a href="#" class="block py-2 page-link" data-page="student">Student</a></li>
            <li class="mb-2"><a href="#" class="block py-2 page-link" data-page="users">Users</a></li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block py-2 bg-red-500 rounded w-full text-center text-white">
                    Logout
                </button>
            </form>
        </ul>
    </aside>

    <!-- Main Content -->
    <main id="mainContent" class="w-full flex-1 p-6 mt-16 md:mt-0 bg-gray-100 transition-all duration-300">
        <div id="contentContainer">
            @yield('content') <!-- This will render the content of the child view, such as 'admin.home.index' -->
        </div>
    </main>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');

        // Toggle sidebar visibility on mobile
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full'); // Show/hide the sidebar
        });

        document.querySelectorAll('.page-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                const page = this.getAttribute('data-page');
                // Perform a full redirect to the corresponding page
                window.location.href = `/admin/${page}`; // Redirect to the appropriate URL
            });
        });
    </script>
    @stack('scripts')

</body>
</html>
