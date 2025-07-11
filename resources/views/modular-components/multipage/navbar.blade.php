<nav id="#nav" class="bg-blue-600 p-4 shadow" x-data="{ open: false }">
    <div class="w-full mx-auto flex justify-between items-center">
        <a href="/" class="flex justify-center items-center gap-4 cursor-pointer w-fit">
            <div class="w-[50px] flex justify-start items-center">
                <img src="{{ asset('images/baw-logo-white.png') }}"
                     alt="Welcome"
                     class="h-full w-auto object-contain rounded-lg" />
            </div>
            <div class="text-white text-2xl font-bold flex justify-center items-center">PKBM Bina Abdi Wiyata</div>
        </a>

        <div class="hidden lg:flex space-x-2 justify-center items-center">
            <a href="/" class="text-white font-medium px-3 py-2 rounded hover:bg-blue-700 transition">Home</a>
            <a href="{{ route('register') }}" class="text-white font-medium px-3 py-2 rounded hover:bg-blue-700 transition">Admission</a>
            <a href="{{ route('programs') }}" class="text-white font-medium px-3 py-2 rounded hover:bg-blue-700 transition">Our Programs</a>
            <a href="{{ route('contact') }}" class="text-white font-medium px-3 py-2 rounded hover:bg-blue-700 transition">Contact Us</a>
            <a href="{{ route('activities') }}" class="text-white font-medium px-3 py-2 rounded hover:bg-blue-700 transition">Our Activities</a>

            <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100 transition">
                Login
            </a>
        </div>

        <button @click="open = !open" class="lg:hidden text-white focus:outline-none" aria-label="Toggle Menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Mobile Dropdown -->
    <div x-show="open" @click.away="open = false" x-transition class="lg:hidden mt-2 bg-blue-600 space-y-3 rounded-lg">
        <a href="/" class="block text-white font-medium px-3 py-2 rounded hover:bg-blue-700 transition mt-4">Home</a>
        <a href="{{ route('register') }}" class="block text-white font-medium px-3 py-2 rounded hover:bg-blue-700 transition">Admission</a>
        <a href="{{ route('programs') }}" class="block text-white font-medium px-3 py-2 rounded hover:bg-blue-700 transition">Our Programs</a>
        <a href="{{ route('activities') }}" class="block text-white font-medium px-3 py-2 rounded hover:bg-blue-700 transition">Our Activities</a>
        <a href="{{ route('contact') }}" class="block text-white font-medium px-3 py-2 rounded hover:bg-blue-700 transition">Contact Us</a>

        <!-- Login Button -->
        <a href="{{ route('login') }}" class="block text-center bg-white text-blue-600 font-semibold px-4 py-2 mt-2 rounded hover:bg-blue-100 transition">
            Login
        </a>
    </div>
</nav>
