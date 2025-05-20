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
            <li class="mb-2">
                <a href="{{ url('/admin/home') }}"
                   class="block py-2 px-2 rounded page-link {{ request()->is('admin/home') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="home">Home</a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/admin/announcements') }}"
                   class="block py-2 px-2 rounded page-link {{ request()->is('admin/announcements') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="announcements">Announcement</a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/admin/teacher') }}"
                   class="block py-2 px-2 rounded page-link {{ request()->is('admin/teacher') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="teacher">Teacher</a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/admin/students') }}"
                   class="block py-2 px-2 rounded page-link {{ request()->is('admin/students') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="students">Student</a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/admin/classrooms') }}"
                   class="block py-2 px-2 rounded page-link {{ request()->is('admin/classrooms') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="classrooms">Classroom</a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/admin/subjects') }}"
                   class="block py-2 px-2 rounded page-link {{ request()->is('admin/subjects') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="subjects">Subject</a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/admin/schedules') }}"
                   class="block py-2 px-2 rounded page-link {{ request()->is('admin/schedules') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="schedules">Schedule</a>
            </li>
            <li class="mb-2">
                <a href="{{ url('/admin/tasks') }}"
                   class="block py-2 px-2 rounded page-link {{ request()->is('admin/tasks') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                   data-page="tasks">Student Task</a>
            </li>
            <li class="mb-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block py-2 bg-red-500 rounded w-full text-center text-white">
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

        // Dynamic highlighting (client-side fallback)
        const currentPath = window.location.pathname;
        document.querySelectorAll('.page-link').forEach(link => {
            const page = link.getAttribute('data-page');
            if (currentPath.includes(`/admin/${page}`)) {
                link.classList.add('bg-blue-800', 'rounded', 'px-2');
            }
        });

        // Optional: handle click redirects (if using AJAX or dynamic UI)
        document.querySelectorAll('.page-link').forEach(link => {
            link.addEventListener('click', function(event) {
                // If not using hrefs directly
                // event.preventDefault();
                // const page = this.getAttribute('data-page');
                // window.location.href = `/admin/${page}`;
            });
        });
    </script>
    @stack('scripts')

</body>
</html>
