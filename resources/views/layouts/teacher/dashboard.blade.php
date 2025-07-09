<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
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
                <a href="{{ url('/teacher/home') }}"
                   class="flex items-center gap-2 py-2 px-2 rounded page-link {{ request()->is('teacher/home') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="home">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    Home
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/teacher/materials') }}"
                   class="flex items-center gap-2 py-2 px-2 rounded page-link {{ request()->is('teacher/materials') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="materials">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    Materials
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/teacher/tasks') }}"
                   class="flex items-center gap-2 py-2 px-2 rounded page-link {{ request()->is('teacher/tasks') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="tasks">
                    <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                    Tasks
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/teacher/schedules') }}"
                   class="flex items-center gap-2 py-2 px-2 rounded page-link {{ request()->is('teacher/schedules') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="schedules">
                    <i data-lucide="calendar-clock" class="w-5 h-5"></i>
                    Schedules
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/teacher/presence') }}"
                   class="flex items-center gap-2 py-2 px-2 rounded page-link {{ request()->is('teacher/presence') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="presence">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    Presence
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/teacher/profile') }}"
                   class="flex items-center gap-2 py-2 px-2 rounded page-link {{ request()->is('teacher/profile') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="profile">
                    <i data-lucide="user" class="w-5 h-5"></i>
                    Profile
                </a>
            </li>
            <li class="mb-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 py-2 px-2 bg-red-500 rounded w-full text-white hover:bg-red-600 transition">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        Logout
                    </button>
                </form>
            </li>
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

        menuToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        const currentPath = window.location.pathname;
        document.querySelectorAll('.page-link').forEach(link => {
            const page = link.getAttribute('data-page');
            if (currentPath.includes(`/teacher/${page}`)) {
                link.classList.add('bg-blue-800', 'rounded', 'px-2');
            }
        });

        lucide.createIcons(); // Activate Lucide icons
    </script>
    @stack('scripts')

</body>
</html>
