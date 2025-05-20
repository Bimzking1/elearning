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
    <nav class="fixed top-0 left-0 w-full bg-blue-600 text-white p-4 md:hidden flex justify-between items-center z-20">
        <h2 class="text-xl font-bold">Dashboard</h2>
        <button id="menuToggle" class="bg-white text-blue-600 p-2 rounded-md">
            ☰
        </button>
    </nav>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-blue-600 min-h-screen text-white p-4 fixed md:relative md:translate-x-0 transition-transform duration-300 -translate-x-full z-10">
        <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
        <ul>
            <li class="mb-2 mt-8 md:mt-0">
                <a href="{{ url('/student/home') }}"
                   class="block py-2 px-2 rounded page-link {{ request()->is('student/home') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="home">Home</a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/student/schedules') }}"
                   class="block py-2 px-2 rounded page-link {{ request()->is('student/schedules') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="schedules">Schedule</a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/student/tasks') }}"
                   class="block py-2 px-2 rounded page-link {{ request()->is('student/tasks') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="tasks">Task</a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/student/profile') }}"
                   class="block py-2 px-2 rounded page-link {{ request()->is('student/profile') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="profile">Profile</a>
            </li>
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
            @yield('content')
        </div>
    </main>

    <!-- JavaScript -->
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');

        // Toggle sidebar visibility on mobile
        menuToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full'); // Show/hide the sidebar
        });

        const currentPath = window.location.pathname;
        document.querySelectorAll('.page-link').forEach(link => {
            const page = link.getAttribute('data-page');
            if (currentPath.includes(`/student/${page}`)) {
                link.classList.add('bg-blue-800', 'rounded', 'px-2');
            }
        });
    </script>
    @stack('scripts')

</body>
</html>
