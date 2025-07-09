<!-- Footer -->
<footer class="bg-blue-600 text-white py-10 text-center md:text-left">
    <div class="w-full mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">
        <!-- Organization Info -->
        <div class="flex flex-col justify-center items-center md:justify-start md:items-start">
            <div class="w-[80px] flex justify-center md:justify-start items-center mb-4">
                <img src="{{ asset('images/baw-logo-white.png') }}"
                     alt="Welcome"
                     class="h-full w-auto object-contain rounded-lg" />
            </div>
            <h3 class="text-lg font-semibold mb-3">PKBM BINA ABDI WIYATA</h3>
            <p>JL. Jolotundo Baru 6, Tambaksari</p>
            <p>Kelurahan Pacar Keling</p>
            <p>Kota Surabaya, Jawa Timur</p>
            <p class="mt-4">Email: <a href="mailto:pkbmbaw2019@gmail.com" class="">pkbmbaw2019@gmail.com</a></p>
            <p>Website: <a href="https://www.binaabdiwiyata.id" target="_blank" class="">binaabdiwiyata.id</a></p>
            <p>No. Telp.:
                <a href="https://wa.me/6287701990961" target="_blank" rel="noopener noreferrer"
                class="text-white hover:underline no-underline visited:text-white visited:no-underline">
                    087701990961
                </a>
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Quick Links</h3>
            <ul class="space-y-2">
                <li><a href="/" class="hover:underline">Home</a></li>
                <li><a href="#about" class="hover:underline">About</a></li>
                <li><a href="#why" class="hover:underline">Why Choose Us</a></li>
                <li><a href="#motto" class="hover:underline">Our Motto</a></li>
                <li><a href="#teachers" class="hover:underline">Teachers</a></li>
                <li><a href="#services" class="hover:underline">Services</a></li>
                <li><a href="#activities" class="hover:underline">Activities</a></li>
                <li><a href="{{ route('login') }}" class="hover:underline">Login</a></li>
            </ul>
        </div>

        <!-- Our Services -->
        <div>
            <h3 class="text-lg font-semibold mb-3"><a href="{{ route('programs') }}">Our Programs</a></h3>
            <ul class="space-y-2">
                <li><a href="{{ route('programs') }}">Paket A (SD)</a></li>
                <li><a href="{{ route('programs') }}">Paket B (SMP)</a></li>
                <li><a href="{{ route('programs') }}">Paket C (SMA)</a></li>
                <li><a href="{{ route('programs') }}">Homeschooling</a></li>
            </ul>
        </div>

        <!-- Social Media -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Follow Us</h3>
            <div class="flex justify-center items-center gap-4 md:space-x-4 mt-2 md:justify-start md:items-start md:gap-0">
                <a href="#" class="hover:text-blue-200" aria-label="Facebook">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M22 12A10 10 0 1 0 12 22v-7h-2v-3h2v-2c0-1.7 1.3-3 3-3h2v3h-2c-.6 0-1 .4-1 1v1h3l-1 3h-2v7a10 10 0 0 0 8-10Z"/></svg>
                </a>
                <a href="#" class="hover:text-blue-200" aria-label="Instagram">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.8.1 1.2.1 1.8.2 2.2.4.5.2.9.5 1.3.9s.7.8.9 1.3c.2.4.3 1 .4 2.2.1 1.2.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 1.2-.2 1.8-.4 2.2-.2.5-.5.9-.9 1.3s-.8.7-1.3.9c-.4.2-1 .3-2.2.4-1.2.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-1.2-.1-1.8-.2-2.2-.4a3.5 3.5 0 0 1-1.3-.9 3.5 3.5 0 0 1-.9-1.3c-.2-.4-.3-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.8c.1-1.2.2-1.8.4-2.2.2-.5.5-.9.9-1.3s.8-.7 1.3-.9c.4-.2 1-.3 2.2-.4C8.4 2.2 8.8 2.2 12 2.2Zm0 2c-3.1 0-3.5 0-4.7.1-1 .1-1.5.2-1.8.3a2 2 0 0 0-.7.4 2 2 0 0 0-.4.7c-.1.3-.2.8-.3 1.8-.1 1.2-.1 1.6-.1 4.7s0 3.5.1 4.7c.1 1 .2 1.5.3 1.8.1.3.2.5.4.7.2.2.4.3.7.4.3.1.8.2 1.8.3 1.2.1 1.6.1 4.7.1s3.5 0 4.7-.1c1-.1 1.5-.2 1.8-.3.3-.1.5-.2.7-.4.2-.2.3-.4.4-.7.1-.3.2-.8.3-1.8.1-1.2.1-1.6.1-4.7s0-3.5-.1-4.7c-.1-1-.2-1.5-.3-1.8a2 2 0 0 0-.4-.7 2 2 0 0 0-.7-.4c-.3-.1-.8-.2-1.8-.3-1.2-.1-1.6-.1-4.7-.1Zm0 3.8a6 6 0 1 1 0 12 6 6 0 0 1 0-12Zm0 2a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm4.5-2.1a1.1 1.1 0 1 1 0 2.2 1.1 1.1 0 0 1 0-2.2Z"/></svg>
                </a>
                <a href="#" class="hover:text-blue-200" aria-label="YouTube">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M10 15l5-3-5-3v6Zm12-3c0-1.8 0-3.2-.1-4.3-.1-1.2-.4-2.1-.9-2.7a4 4 0 0 0-1.7-1.7c-.6-.4-1.5-.7-2.7-.8C15.2 3.2 13.8 3.2 12 3.2s-3.2 0-4.3.1c-1.2.1-2.1.4-2.7.9a4 4 0 0 0-1.7 1.7c-.4.6-.7 1.5-.8 2.7C3.2 8.8 3.2 10.2 3.2 12s0 3.2.1 4.3c.1 1.2.4 2.1.8 2.7.4.6 1 1.2 1.7 1.6.6.4 1.5.7 2.7.8 1.1.1 2.5.1 4.3.1s3.2 0 4.3-.1c1.2-.1 2.1-.4 2.7-.8.6-.4 1.2-1 1.6-1.7.4-.6.7-1.5.8-2.7.1-1.1.1-2.5.1-4.3Z"/></svg>
                </a>
            </div>
        </div>
    </div>

    <div class="border-t border-blue-400 mt-8 pt-4 text-center text-sm">
        <p>&copy; {{ date('Y') }} PKBM BINA ABDI WIYATA. All rights reserved.</p>
    </div>
</footer>
