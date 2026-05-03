<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap');
    @keyframes navFadeDown {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .nav-dropdown {
        animation: navFadeDown 0.2s ease forwards;
    }

    /* Active / current page indicator */
    .nav-link {
        position: relative;
        font-family: 'DM Sans', sans-serif;
    }
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 1.5px;
        background: rgba(255,255,255,0.7);
        border-radius: 999px;
        transition: width 0.25s ease;
    }
    .nav-link:hover::after {
        width: 60%;
    }
    nav, nav * {
        font-family: 'DM Sans', sans-serif;
    }
</style>

<nav class="sticky top-0 z-50 bg-gradient-to-tr from-blue-700 to-blue-900 shadow-lg"
     x-data="{ open: false }"
     @keydown.escape.window="open = false">

    <div class="max-w-[1280px] mx-auto px-5 md:px-8 flex justify-between items-center h-16">

        <!-- Logo & Name -->
        <a href="/" class="flex items-center gap-3 group flex-shrink-0">
            <div class="w-[42px] h-[42px] flex items-center justify-center rounded-xl overflow-hidden
                        transition-all duration-200">
                <img src="{{ asset('images/baw-logo-white.webp') }}"
                     alt="PKBM BAW Logo"
                     class="w-full h-full object-contain p-1" />
            </div>
            <div class="flex flex-col leading-tight">
                <!-- <span class="text-white font-bold text-base tracking-wide">PKBM Homeschooling</span> -->
                <span class="text-blue-200 text-[10px] tracking-widest uppercase">PKBM Homeschooling</span>
                <!-- <span class="text-white font-bold text-base tracking-wide">Bina Abdi Wiyata</span> -->
                <span class="text-blue-200 text-[14px] font-bold tracking-widest uppercase">Bina Abdi Wiyata</span>
                <!-- <span class="text-blue-200 text-[10px] tracking-widest uppercase hidden sm:block">Community Learning Centre</span> -->
            </div>
        </a>

        <!-- Desktop Links -->
        <div class="hidden lg:flex items-center gap-1">
            <a href="/"
               class="nav-link text-white/90 hover:text-white text-sm font-medium px-3.5 py-2 rounded-lg hover:bg-white/10 transition-colors duration-200">
                Home
            </a>
            <a href="{{ route('register') }}"
               class="nav-link text-white/90 hover:text-white text-sm font-medium px-3.5 py-2 rounded-lg hover:bg-white/10 transition-colors duration-200">
                Admission
            </a>
            <a href="{{ route('programs') }}"
               class="nav-link text-white/90 hover:text-white text-sm font-medium px-3.5 py-2 rounded-lg hover:bg-white/10 transition-colors duration-200">
                Programs
            </a>
            <a href="{{ route('activities') }}"
               class="nav-link text-white/90 hover:text-white text-sm font-medium px-3.5 py-2 rounded-lg hover:bg-white/10 transition-colors duration-200">
                Activities
            </a>
            <a href="{{ route('contact') }}"
               class="nav-link text-white/90 hover:text-white text-sm font-medium px-3.5 py-2 rounded-lg hover:bg-white/10 transition-colors duration-200">
                Contact
            </a>

            <!-- Divider -->
            <span class="w-px h-5 bg-white/20 mx-2"></span>

            <a href="{{ route('login') }}"
               class="inline-flex items-center gap-1.5 bg-white text-[#1e3a5f] text-sm font-semibold
                      px-4 py-2 rounded-lg hover:bg-blue-50 transition-colors duration-200 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Login
            </a>
        </div>

        <!-- Mobile Hamburger -->
        <button @click="open = !open"
                class="lg:hidden flex items-center justify-center w-10 h-10 rounded-lg text-white hover:bg-white/10 transition-colors duration-200 focus:outline-none"
                aria-label="Toggle Menu">
            <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Mobile Dropdown -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         @click.away="open = false"
         style="display:none"
         class="lg:hidden bg-gradient-to-br from-blue-700 to-blue-900 px-5 py-4 space-y-1">

        <a href="/" class="flex items-center gap-2 text-white/90 hover:text-white text-sm font-medium px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors duration-200">
            <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Home
        </a>
        <a href="{{ route('register') }}" class="flex items-center gap-2 text-white/90 hover:text-white text-sm font-medium px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors duration-200">
            <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Admission
        </a>
        <a href="{{ route('programs') }}" class="flex items-center gap-2 text-white/90 hover:text-white text-sm font-medium px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors duration-200">
            <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z"/></svg>
            Programs
        </a>
        <a href="{{ route('activities') }}" class="flex items-center gap-2 text-white/90 hover:text-white text-sm font-medium px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors duration-200">
            <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Activities
        </a>
        <a href="{{ route('contact') }}" class="flex items-center gap-2 text-white/90 hover:text-white text-sm font-medium px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors duration-200">
            <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Contact
        </a>

        <div class="pt-4 border-t border-white/10">
            <a href="{{ route('login') }}"
               class="flex items-center justify-center gap-2 bg-white text-[#1e3a5f] text-sm font-semibold
                      px-4 py-2.5 rounded-lg hover:bg-blue-50 transition-colors duration-200 w-full shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Login
            </a>
        </div>
    </div>
</nav>