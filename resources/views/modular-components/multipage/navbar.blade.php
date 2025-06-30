<nav id="#nav" class="bg-blue-600 p-4 shadow" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="/" class="flex justify-center items-center gap-4 cursor-pointer w-fit">
            <div class="w-[50px] flex justify-start items-center">
                <img src="{{ asset('images/baw-logo-white.png') }}"
                     alt="Welcome"
                     class="h-full w-auto object-contain rounded-lg" />
            </div>
            <div class="text-white text-2xl font-bold flex justify-center items-center">PKBM Bina Abdi Wiyata</div>
        </a>

        <div class="hidden md:flex space-x-4 justify-center items-center">
            <a href="/" class="text-white hover:underline">Home</a>
            <a href="{{ route('register') }}" class="text-white hover:underline">Register</a>
            <a href="{{ route('programs') }}" class="text-white hover:underline">Our Programs</a>
            <a href="{{ route('contact') }}" class="text-white hover:underline">Contact Us</a>
            <a href="{{ route('activities') }}" class="text-white hover:underline">Our Activities</a>
            <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">Login</a>
        </div>

        {{-- <div class="hidden md:flex space-x-4 justify-center items-center">
            <a href="#about" class="text-white hover:underline">About</a>
            <a href="#motto" class="text-white hover:underline">Motto</a>
            <a href="#teachers" class="text-white hover:underline">Teachers</a>
            <a href="#services" class="text-white hover:underline">Services</a>
            <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">Login</a>
        </div> --}}

        <button @click="open = !open" class="md:hidden text-white focus:outline-none" aria-label="Toggle Menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <div x-show="open" @click.away="open = false" x-transition class="md:hidden mt-2 space-y-2 px-4">
        <a href="/" class="text-white hover:underline">Home</a>
        <a href="{{ route('register') }}" class="text-white hover:underline">Register</a>
        <a href="{{ route('programs') }}" class="text-white hover:underline">Our Programs</a>
        <a href="{{ route('contact') }}" class="text-white hover:underline">Contact Us</a>
        <a href="{{ route('activities') }}" class="text-white hover:underline">Our Activities</a>
        <a href="{{ route('login') }}" class="block bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">Login</a>
    </div>

    {{-- <div x-show="open" @click.away="open = false" x-transition class="md:hidden mt-2 space-y-2 px-4">
        <a href="#about" class="block text-white hover:underline">About</a>
        <a href="#motto" class="block text-white hover:underline">Motto</a>
        <a href="#teachers" class="block text-white hover:underline">Teachers</a>
        <a href="#services" class="block text-white hover:underline">Services</a>
        <a href="{{ route('login') }}" class="block bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">Login</a>
    </div> --}}
</nav>
