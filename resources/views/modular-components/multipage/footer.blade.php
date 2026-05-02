<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap');
    footer, footer * {
        font-family: 'DM Sans', sans-serif;
    }
</style>

<!-- Footer -->
<footer class="bg-gradient-to-b from-blue-700 to-blue-900 text-white pt-14 pb-8">
    <div class="w-full max-w-[1280px] mx-auto px-8 grid grid-cols-1 md:grid-cols-4 gap-10 text-sm">

        <!-- Organization Info -->
        <div class="flex flex-col justify-center items-center md:justify-start md:items-start">
            <div class="w-[90px] rounded-lg overflow-hidden flex justify-center md:justify-start items-center mb-5">
                <img src="{{ asset('images/baw-logo-white.png') }}"
                     alt="PKBM BAW Logo"
                     class="h-full w-auto object-contain opacity-90" />
            </div>
            <h3 class="text-base font-bold tracking-widest uppercase text-blue-200 mb-4">PKBM Homeschooling <br> Bina Abdi Wiyata</h3>
            <div class="space-y-1 text-blue-100 leading-relaxed text-center md:text-left">
                <p>JL. Jolotundo Baru 6, Tambaksari</p>
                <p>Kel. Pacar Keling, Kota Surabaya</p>
                <p>Jawa Timur, Indonesia</p>
            </div>
            <div class="mt-5 space-y-1.5 text-blue-100 text-center md:text-left">
                <p>
                    <span class="text-blue-300 font-medium">Email</span><br>
                    <a href="mailto:pkbmbaw2019@gmail.com" class="hover:text-white transition-colors duration-200">
                        pkbmbaw2019@gmail.com
                    </a>
                </p>
                <p>
                    <span class="text-blue-300 font-medium">Website</span><br>
                    <a href="https://www.binaabdiwiyata.id" target="_blank" class="hover:text-white transition-colors duration-200">
                        binaabdiwiyata.id
                    </a>
                </p>
                <p>
                    <span class="text-blue-300 font-medium">WhatsApp</span><br>
                    <a href="https://wa.me/6287701990961" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors duration-200 block">
                        0877 0199 0961
                    </a>
                    <a href="https://wa.me/6281231166033" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors duration-200 block">
                        0812 3116 6033
                    </a>
                </p>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="flex flex-col items-center md:items-start">
            <h3 class="text-base font-bold tracking-widest uppercase text-blue-200 mb-4">Quick Links</h3>
            <ul class="space-y-2 text-blue-100 text-center md:text-left">
                <li><a href="/" class="hover:text-white transition-colors duration-200">Home</a></li>
                <li><a href="#about" class="hover:text-white transition-colors duration-200">About</a></li>
                <li><a href="#why" class="hover:text-white transition-colors duration-200">Why Choose Us</a></li>
                <li><a href="#motto" class="hover:text-white transition-colors duration-200">Our Motto</a></li>
                <li><a href="#teachers" class="hover:text-white transition-colors duration-200">Teachers</a></li>
                <li><a href="#services" class="hover:text-white transition-colors duration-200">Services</a></li>
                <li><a href="#activities" class="hover:text-white transition-colors duration-200">Activities</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-white transition-colors duration-200">Login</a></li>
            </ul>
        </div>

        <!-- Our Programs -->
        <div class="flex flex-col items-center md:items-start">
            <h3 class="text-base font-bold tracking-widest uppercase text-blue-200 mb-4">
                <a href="{{ route('programs') }}" class="hover:text-white transition-colors duration-200">Our Programs</a>
            </h3>
            <ul class="space-y-2 text-blue-100 text-center md:text-left">
                <li><a href="{{ route('programs') }}" class="hover:text-white transition-colors duration-200">Paket A (SD)</a></li>
                <li><a href="{{ route('programs') }}" class="hover:text-white transition-colors duration-200">Paket B (SMP)</a></li>
                <li><a href="{{ route('programs') }}" class="hover:text-white transition-colors duration-200">Paket C (SMA)</a></li>
                <li><a href="{{ route('programs') }}" class="hover:text-white transition-colors duration-200">Homeschooling</a></li>
            </ul>
        </div>

        <!-- Social Media -->
        <div class="flex flex-col items-center md:items-start">
            <h3 class="text-base font-bold tracking-widest uppercase text-blue-200 mb-4">Follow Us</h3>
            <div class="flex gap-3 mt-1">
                <a href="#" aria-label="Facebook"
                   class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-400 text-blue-200 hover:bg-white hover:text-blue-700 transition-all duration-200">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M22 12A10 10 0 1 0 12 22v-7h-2v-3h2v-2c0-1.7 1.3-3 3-3h2v3h-2c-.6 0-1 .4-1 1v1h3l-1 3h-2v7a10 10 0 0 0 8-10Z"/></svg>
                </a>
                <a href="#" aria-label="Instagram"
                   class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-400 text-blue-200 hover:bg-white hover:text-blue-700 transition-all duration-200">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.8.1 1.2.1 1.8.2 2.2.4.5.2.9.5 1.3.9s.7.8.9 1.3c.2.4.3 1 .4 2.2.1 1.2.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 1.2-.2 1.8-.4 2.2-.2.5-.5.9-.9 1.3s-.8.7-1.3.9c-.4.2-1 .3-2.2.4-1.2.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-1.2-.1-1.8-.2-2.2-.4a3.5 3.5 0 0 1-1.3-.9 3.5 3.5 0 0 1-.9-1.3c-.2-.4-.3-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.8c.1-1.2.2-1.8.4-2.2.2-.5.5-.9.9-1.3s.8-.7 1.3-.9c.4-.2 1-.3 2.2-.4C8.4 2.2 8.8 2.2 12 2.2Zm0 2c-3.1 0-3.5 0-4.7.1-1 .1-1.5.2-1.8.3a2 2 0 0 0-.7.4 2 2 0 0 0-.4.7c-.1.3-.2.8-.3 1.8-.1 1.2-.1 1.6-.1 4.7s0 3.5.1 4.7c.1 1 .2 1.5.3 1.8.1.3.2.5.4.7.2.2.4.3.7.4.3.1.8.2 1.8.3 1.2.1 1.6.1 4.7.1s3.5 0 4.7-.1c1-.1 1.5-.2 1.8-.3.3-.1.5-.2.7-.4.2-.2.3-.4.4-.7.1-.3.2-.8.3-1.8.1-1.2.1-1.6.1-4.7s0-3.5-.1-4.7c-.1-1-.2-1.5-.3-1.8a2 2 0 0 0-.4-.7 2 2 0 0 0-.7-.4c-.3-.1-.8-.2-1.8-.3-1.2-.1-1.6-.1-4.7-.1Zm0 3.8a6 6 0 1 1 0 12 6 6 0 0 1 0-12Zm0 2a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm4.5-2.1a1.1 1.1 0 1 1 0 2.2 1.1 1.1 0 0 1 0-2.2Z"/></svg>
                </a>
                <a href="#" aria-label="YouTube"
                   class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-400 text-blue-200 hover:bg-white hover:text-blue-700 transition-all duration-200">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M10 15l5-3-5-3v6Zm12-3c0-1.8 0-3.2-.1-4.3-.1-1.2-.4-2.1-.9-2.7a4 4 0 0 0-1.7-1.7c-.6-.4-1.5-.7-2.7-.8C15.2 3.2 13.8 3.2 12 3.2s-3.2 0-4.3.1c-1.2.1-2.1.4-2.7.9a4 4 0 0 0-1.7 1.7c-.4.6-.7 1.5-.8 2.7C3.2 8.8 3.2 10.2 3.2 12s0 3.2.1 4.3c.1 1.2.4 2.1.8 2.7.4.6 1 1.2 1.7 1.6.6.4 1.5.7 2.7.8 1.1.1 2.5.1 4.3.1s3.2 0 4.3-.1c1.2-.1 2.1-.4 2.7-.8.6-.4 1.2-1 1.6-1.7.4-.6.7-1.5.8-2.7.1-1.1.1-2.5.1-4.3Z"/></svg>
                </a>
            </div>

            <!-- Accreditation badge -->
            <div class="mt-8 border border-blue-400 rounded-xl px-5 py-4 text-center md:text-left">
                <p class="text-xs text-blue-300 uppercase tracking-widest mb-1">Accreditation</p>
                <p class="text-2xl font-bold text-white">A</p>
                <p class="text-xs text-blue-200 mt-1 leading-snug">Ministry of Education<br>Republic of Indonesia</p>
            </div>
        </div>

    </div>

    <!-- Divider + Copyright -->
    <div class="border-t border-blue-600 mt-12 pt-6 text-center text-xs text-blue-300 tracking-wide">
        <p>&copy; {{ date('Y') }} PKBM Homeschooling Bina Abdi Wiyata &mdash; All rights reserved.</p>
    </div>
</footer>