<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-white text-2xl font-bold">E-Learning</a>

            <!-- Desktop Links -->
            <div class="hidden md:flex space-x-4 justify-center items-center">
                <a href="#about" class="text-white hover:underline">About</a>
                <a href="#motto" class="text-white hover:underline">Motto</a>
                <a href="#teachers" class="text-white hover:underline">Teachers</a>
                <a href="#services" class="text-white hover:underline">Services</a>
                <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">Login</a>
            </div>

            <!-- Mobile Menu Button -->
            <button
                @click="open = !open"
                class="md:hidden text-white focus:outline-none"
                aria-label="Toggle Menu"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Dropdown -->
        <div x-show="open" @click.away="open = false" x-transition class="md:hidden mt-2 space-y-2 px-4">
            <a href="#about" class="block text-white hover:underline">About</a>
            <a href="#motto" class="block text-white hover:underline">Motto</a>
            <a href="#teachers" class="block text-white hover:underline">Teachers</a>
            <a href="#services" class="block text-white hover:underline">Services</a>
            <a href="{{ route('login') }}" class="block bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">Login</a>
        </div>
    </nav>

    <!-- Hero -->
    <header class="bg-blue-500 text-white py-20 text-center">
        <h1 class="text-5xl font-bold mb-4">Welcome to Our E-Learning Platform</h1>
        <p class="text-xl">Flexible, Effective, and Student-Focused Learning</p>
        <a href="{{ route('login') }}" class="mt-6 inline-block bg-white text-blue-600 px-6 py-3 rounded font-semibold">Login</a>
    </header>

    <!-- About Us -->
    <section id="about" class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">About PKBM Bina Abdi Wiyata</h2>
            <p class="text-lg text-gray-600 mb-6">
                PKBM Bina Abdi Wiyata is a Community Learning Center (PKBM) that provides non-formal education programs, including Kejar Paket A (equivalent to elementary school), Paket B (junior high school), and Paket C (senior high school), as well as flexible and personalized homeschooling services. Our mission is to offer educational opportunities to individuals of all ages and backgrounds who are seeking to continue or complete their education outside the formal school system.

                Founded on the principles of inclusion and empowerment, we believe that education is a fundamental right for everyone—regardless of age, economic status, or past educational experience. Through both our Kejar Paket and homeschooling programs, we offer learner-centered approaches that are aligned with the national curriculum and tailored to each student's needs.

                Our homeschooling program is designed for families who prefer a home-based learning model. It offers flexible scheduling, personalized learning plans, academic support, and preparation for national examinations—all under the guidance of experienced educators.
            </p>
        </div>
    </section>

    <!-- Motto -->
    <section id="motto" class="py-16 bg-gray-100">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Our Motto</h2>
            <p class="text-xl italic text-blue-600">"A Life-improving Centre for Community Learning Activities"</p>
        </div>
    </section>

    <!-- Our Teachers -->

      <section id="teachers" class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Meet Our Dedicated Teachers</h2>
            <p class="text-lg text-gray-600 mb-6">
                At PKBM BINA ABDI WIYATA, our teachers are passionate educators committed to guiding students toward success. With diverse academic backgrounds, real-world experience, and a heart for teaching, they create a supportive and engaging learning environment tailored to each student's needs.

                Our team includes certified professionals who specialize in various subjects and levels of education, ensuring every student receives personalized support. Whether in catch-up or pursue programs, our teachers bring patience, innovation, and care to the classroom—empowering learners to reach their full potential.

                We believe that great teachers don't just educate—they inspire.
            </p>

            <div class="carousel-container">
                <div class="slick-carousel">
                    <!-- Slide 1 -->
                    <div class="grid gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 mt-8" id="teacher-row-1">
                        <div class="text-center text-gray-500">
                            <img class="mx-auto mb-4 w-36 h-36 object-cover rounded-full" src="{{ asset('images/lukas-kambali.jpg') }}" alt="Lukas Kambali Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                                <a href="#">Drs. Lukas Kambali, S.H., M.H.</a>
                            </h3>
                            <p>Geografi</p>
                        </div>
                        <div class="text-center text-gray-500">
                            <img class="mx-auto mb-4 w-36 h-36 object-cover rounded-full" src="{{ asset('images/albert-kurniawan.jpg') }}" alt="Helene Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                                <a href="#">Albert Kurniawan, S.T.</a>
                            </h3>
                            <p>Fisika, Biologi, Kimia</p>
                        </div>
                        <div class="text-center text-gray-500">
                            <img class="mx-auto mb-4 w-36 h-36 object-cover rounded-full" src="{{ asset('images/williyan.jpg') }}" alt="Jese Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                                <a href="#">L. Williyan Putra Perdana, S.E., M.M.</a>
                            </h3>
                            <p>Ekonomi</p>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    {{-- <div class="grid gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 hidden mt-8" id="teacher-row-2">
                        <div class="text-center text-gray-500">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="Paulus Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                                <a href="#">Paulus Widhi, S.E.</a>
                            </h3>
                            <p>Ekonomi, Geografi, Sosiologi, Sejarah</p>
                        </div>
                        <div class="text-center text-gray-500">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/helene-engels.png" alt="Baihaqi Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                                <a href="#">Baihaqi Al Chasan, S.Hum.</a>
                            </h3>
                            <p>Sejarah</p>
                        </div>
                        <div class="text-center text-gray-500">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Sutrisno Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                                <a href="#">Sutrisno</a>
                            </h3>
                            <p>Agama Islam</p>
                        </div>
                    </div> --}}
                    <!-- Hidden Rows -->
                    {{-- <div class="grid gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 hidden mt-8" id="teacher-row-3">
                        <div class="text-center text-gray-500">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="Rismawati Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                                <a href="#">Rismawati Sitanggang, S.Pd.</a>
                            </h3>
                            <p>Sosiologi</p>
                        </div>
                        <div class="text-center text-gray-500">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/helene-engels.png" alt="Dr. Budiono Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                                <a href="#">Dr. B. Budiono, M.Pd.</a>
                            </h3>
                            <p>Bahasa Inggris</p>
                        </div>
                        <div class="text-center text-gray-500">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Dr. Himawan Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                                <a href="#">Drs. Himawan Setyo W., M.Pd.</a>
                            </h3>
                            <p>Bahasa Inggris</p>
                        </div>
                    </div> --}}
                    {{-- <div class="grid gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 hidden mt-8" id="teacher-row-4">
                        <div class="text-center text-gray-500">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="Esti Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                                <a href="#">Drs. Esti Nugroho</a>
                            </h3>
                            <p>Matematika</p>
                        </div>
                        <div class="text-center text-gray-500">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/helene-engels.png" alt="Soejatmiko Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                                <a href="#">Drs. Soejatmiko</a>
                            </h3>
                            <p>Bahasa Indonesia</p>
                        </div>
                        <div class="text-center text-gray-500">
                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Fajar Avatar">
                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900">
                                <a href="#">Fajar Novianto</a>
                            </h3>
                            <p>PPKN</p>
                        </div>
                    </div> --}}

                    <!-- See More Button -->
                    {{-- <div class="text-center mt-6">
                        <button id="see-more-btn" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-all duration-300">
                            See More
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>


      <!-- Services -->
    <section id="services" class="py-20 bg-blue-50">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-blue-700">Our Programs & Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">

                <!-- Paket A -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center space-x-3 mb-4">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-blue-600">Paket A (SD)</h3>
                    </div>
                    <p>
                        A foundational education program for learners seeking an elementary school equivalent certification, aligned with national curriculum standards.
                    </p>
                </div>

                <!-- Paket B -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center space-x-3 mb-4">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-blue-600">Paket B (SMP)</h3>
                    </div>
                    <p>
                        A middle school equivalent program tailored for learners continuing their academic journey with a focus on core competencies and life skills.
                    </p>
                </div>

                <!-- Paket C -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center space-x-3 mb-4">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-blue-600">Paket C (SMA)</h3>
                    </div>
                    <p>
                        A high school level program for students aiming to complete their education and receive an SMA-equivalent diploma, preparing them for higher education or employment.
                    </p>
                </div>

                <!-- Homeschooling -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center space-x-3 mb-4">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-blue-600">Homeschooling</h3>
                    </div>
                    <p>
                        A flexible learning option that allows students to study independently from home under the guidance of educators, while following the national curriculum.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-10 mt-12 text-center md:text-left">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">
            <!-- Organization Info -->
            <div>
                <h3 class="text-lg font-semibold mb-3">PKBM BINA ABDI WIYATA</h3>
                <p>JL. Jolotundo Baru 6, Tambaksari</p>
                <p>Kelurahan Pacar Keling</p>
                <p>Kota Surabaya, Jawa Timur</p>
                <p class="mt-4">Email: <a href="mailto:pkbmbaw2019@gmail.com" class="underline">pkbmbaw2019@gmail.com</a></p>
                <p>Website: <a href="https://www.binaabdiwiyata.id" target="_blank" class="underline">binaabdiwiyata.id</a></p>
                <p>Nomor Telepon: 087701990961</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-3">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#about" class="hover:underline">About</a></li>
                    <li><a href="#services" class="hover:underline">Services</a></li>
                    <li><a href="#teachers" class="hover:underline">Teachers</a></li>
                    <li><a href="{{ route('login') }}" class="hover:underline">Login</a></li>
                </ul>
            </div>

            <!-- Our Services -->
            <div>
                <h3 class="text-lg font-semibold mb-3">Our Programs</h3>
                <ul class="space-y-2">
                    <li>Paket A (SD)</li>
                    <li>Paket B (SMP)</li>
                    <li>Paket C (SMA)</li>
                    <li>Homeschooling</li>
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

</body>
</html>

<!-- Alpine.js -->
<script>
    document.getElementById('see-more-btn').addEventListener('click', function() {
        // Toggle visibility of the hidden rows
        document.getElementById('teacher-row-2').classList.toggle('hidden');
        document.getElementById('teacher-row-3').classList.toggle('hidden');
        document.getElementById('teacher-row-4').classList.toggle('hidden');
        document.getElementById('teacher-row-5').classList.toggle('hidden');
        document.getElementById('teacher-row-6').classList.toggle('hidden');

        // Change button text after clicking
        this.textContent = this.textContent === 'See Less' ? 'See More' : 'See Less';
    });
</script>

