<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bina Abdi Wiyata</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="flex w-full h-full">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full bg-blue-600 text-white p-4 md:hidden flex justify-between items-center z-20">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/baw-logo-white.png') }}" alt="Logo" class="w-auto h-8">
            <h2 class="text-xl font-bold">Dashboard</h2>
        </div>
        <button id="menuToggle" class="bg-white text-blue-600 p-2 rounded-md">
            ☰
        </button>
    </nav>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-blue-600 min-h-screen overflow-y-auto text-white p-4 fixed md:relative md:translate-x-0 transition-transform duration-300 -translate-x-full z-10">
        <div class="flex items-center gap-3 mb-6">
            <img src="{{ asset('images/baw-logo-white.png') }}" alt="Logo" class="w-8 h-8 object-contain">
            <h2 class="text-2xl font-bold">Dashboard</h2>
        </div>

        <ul class="space-y-2 mt-12 md:mt-0">
            <li>
                <a href="{{ url('/admin/home') }}"
                class="flex items-center gap-x-2 py-2 px-3 rounded page-link {{ request()->is('admin/home') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                data-page="home">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/announcements') }}"
                class="flex items-center gap-x-2 py-2 px-3 rounded page-link {{ request()->is('admin/announcements') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                data-page="announcements">
                    <i data-lucide="megaphone" class="w-5 h-5"></i>
                    Announcement
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/teacher') }}"
                class="flex items-center gap-x-2 py-2 px-3 rounded page-link {{ request()->is('admin/teacher') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                data-page="teacher">
                    <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                    Teacher
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/students') }}"
                class="flex items-center gap-x-2 py-2 px-3 rounded page-link {{ request()->is('admin/students') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                data-page="students">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Student
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/classrooms') }}"
                class="flex items-center gap-x-2 py-2 px-3 rounded page-link {{ request()->is('admin/classrooms') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                data-page="classrooms">
                    <i data-lucide="building-2" class="w-5 h-5"></i>
                    Classroom
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/subjects') }}"
                class="flex items-center gap-x-2 py-2 px-3 rounded page-link {{ request()->is('admin/subjects') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                data-page="subjects">
                    <i data-lucide="book" class="w-5 h-5"></i>
                    Subject
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/materials') }}"
                class="flex items-center gap-x-2 py-2 px-3 rounded page-link {{ request()->is('admin/materials') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                data-page="materials">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    Materials
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/tasks') }}"
                class="flex items-center gap-x-2 py-2 px-3 rounded page-link {{ request()->is('admin/tasks') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                data-page="tasks">
                    <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                    Student Task
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/schedules') }}"
                class="flex items-center gap-x-2 py-2 px-3 rounded page-link {{ request()->is('admin/schedules') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                data-page="schedules">
                    <i data-lucide="calendar-clock" class="w-5 h-5"></i>
                    Schedule
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/presence') }}"
                class="flex items-center gap-x-2 py-2 px-3 rounded page-link {{ request()->is('admin/presence') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                data-page="presence">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    Presence
                </a>
            </li>
            <li>
                <a href="{{ route('admin.activity-images.index') }}"
                class="flex items-center gap-x-2 py-2 px-3 rounded page-link {{ request()->is('admin/thumbnail*') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                data-page="thumbnail">
                    <i data-lucide="image-plus" class="w-5 h-5"></i>
                    Activity Gallery
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings.edit') }}"
                class="flex items-center gap-x-2 py-2 px-3 rounded page-link {{ request()->is('admin/settings') ? 'bg-blue-800' : 'hover:bg-blue-800 duration-100' }}"
                data-page="settings">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    Setting
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-x-2 w-full py-2 px-3 bg-red-500 hover:bg-red-600 rounded text-white mb-16">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main id="mainContent" class="w-full flex-1 p-6 mt-16 md:mt-0 bg-gray-100 transition-all duration-300 overflow-y-auto">
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
    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')

</body>
</html>
