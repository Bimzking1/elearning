<!-- Hybrid Learning Section -->
<section class="bg-gradient-to-b from-white to-blue-200 text-blue-900 py-8 md:py-20">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-center px-6 gap-10">
        <!-- Text Content -->
        <div class="w-full md:w-fit flex flex-col justify-start md:justify-end items-start md:items-end max-w-xl text-left md:text-right">
            <h2 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">Hybrid Learning</h2>
            <p class="text-lg mb-4 leading-relaxed">
                PKBM Bina Abdi Wiyata — A trusted non-formal education institution with years of experience and an A-level accreditation.
            </p>
            <p class="text-lg mb-4 leading-relaxed">
                We offer a flexible and adaptive learning system, tailored to the unique needs of each student. Learning can take place anytime and anywhere, guided by experienced and dedicated educators.
            </p>
            <p class="text-lg mb-6 leading-relaxed">
                Together with us, help your child grow to their full potential and achieve a limitless future!
            </p>
            <div class="w-full md:w-fit flex flex-col md:flex-row justify-center items-center gap-4">
                <!-- Register Button -->
                <a href="{{ route('register') }}"
                class="w-full md:w-fit text-xl animate-cta inline-block bg-blue-600 text-white hover:bg-blue-700 transition px-6 py-3 rounded font-semibold shadow-md text-center">
                    Student Admission
                </a>

                <!-- Login Button -->
                <a href="{{ route('login') }}"
                class="w-full md:w-fit text-xl inline-block bg-indigo-600 text-white hover:bg-indigo-700 transition px-6 py-3 rounded font-semibold shadow-md text-center">
                    Login as Student/Teacher
                </a>
            </div>

            <!-- Contact Us Button -->
            <div class="w-full md:w-fit flex justify-center md:justify-end mt-4">
                <a href="{{ route('contact') }}"
                class="w-full md:w-fit inline-block bg-white text-blue-600 hover:bg-blue-100 transition px-6 py-3 rounded font-semibold shadow-md text-center">
                    Contact Us
                </a>
            </div>
        </div>

        <!-- Interactive Image -->
        <div class="w-fit flex justify-start items-start">
            <img src="{{ asset('images/welcome-merged.png') }}"
                alt="Welcome"
                class="h-fit md:h-[450px] w-auto object-contain" />
        </div>
    </div>
</section>

<!-- About Us -->
<section id="about" class="py-8 md:py-16 bg-gradient-to-b from-blue-200 to-white text-blue-900">
    <div class="max-w-5xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-blue-900 mb-4">About PKBM Bina Abdi Wiyata</h2>
        <p class="text-lg text-gray-600 mb-6">
            PKBM Bina Abdi Wiyata is a Community Learning Center (PKBM) that provides non-formal education programs, including Kejar Paket A (equivalent to elementary school), Paket B (junior high school), and Paket C (senior high school), as well as flexible and personalized homeschooling services. Our mission is to offer educational opportunities to individuals of all ages and backgrounds who are seeking to continue or complete their education outside the formal school system.

            Founded on the principles of inclusion and empowerment, we believe that education is a fundamental right for everyone—regardless of age, economic status, or past educational experience. Through both our Kejar Paket and homeschooling programs, we offer learner-centered approaches that are aligned with the national curriculum and tailored to each student's needs.

            Our homeschooling program is designed for families who prefer a home-based learning model. It offers flexible scheduling, personalized learning plans, academic support, and preparation for national examinations—all under the guidance of experienced educators.
        </p>
    </div>
</section>

<section id="why" class="py-8 md:py-16 bg-white" id="why-us">
  <div class="w-full mx-auto px-6 md:px-12 flex flex-col gap-12">

    <!-- Title -->
    <div class="w-full space-y-4 flex flex-col justify-center items-center text-center">
      <h2 class="text-3xl font-bold text-blue-900">Why Choose Us</h2>
      <p class="text-lg text-gray-600">
        Why choose <strong>PKBM Bina Abdi Wiyata</strong> as your child’s education partner?
      </p>
    </div>

    <!-- Features -->
    <div class="grid md:grid-cols-2 gap-10 max-w-5xl mx-auto">

      <!-- Left Column -->
      <div class="space-y-8">
        <!-- Legal -->
        <div>
          <h4 class="text-xl font-semibold text-blue-700">Officially Registered & Accredited</h4>
          <p class="text-gray-700">
            We are officially licensed by the Ministry of Education and the Surabaya Education Department, and accredited with an “A” rating as a trusted non-formal education institution.
          </p>
        </div>

        <!-- Achievements -->
        <div>
          <h4 class="text-xl font-semibold text-blue-700">Proven Track Record</h4>
          <p class="text-gray-700">
            For over a decade, we’ve supported students in achieving accolades at local, regional, and national levels.
          </p>
        </div>

        <!-- Flexibility -->
        <div>
          <h4 class="text-xl font-semibold text-blue-700">Flexible Learning System</h4>
          <p class="text-gray-700">
            Learn when, where, and how you want. We offer self-paced, online, private, and community-based learning options to suit each student's needs.
          </p>
        </div>
      </div>

      <!-- Right Column -->
      <div class="space-y-8">
        <!-- LMS -->
        <div>
          <h4 class="text-xl font-semibold text-blue-700">Modern LMS Platform</h4>
          <p class="text-gray-700">
            Our Learning Management System (LMS) makes studying more interactive, enjoyable, and well-structured.
          </p>
        </div>

        <!-- Higher Education Support -->
        <div>
          <h4 class="text-xl font-semibold text-blue-700">Pathways to Higher Education</h4>
          <p class="text-gray-700">
            Our students are well-prepared to continue their education at public or private schools and universities.
          </p>
        </div>

        <!-- Professional Team -->
        <div>
          <h4 class="text-xl font-semibold text-blue-700">Experienced & Dedicated Team</h4>
          <p class="text-gray-700">
            Run by a team of experienced educators and graduates from top universities, committed to delivering quality education.
          </p>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- Motto -->
<section id="motto" class="py-8 md:py-16 bg-gradient-to-b from-white to-blue-200 flex flex-col justify-center items-center">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-blue-900 mb-4">Our Motto</h2>
        <p class="text-xl italic text-blue-600">"A Life-improving Centre for Community Learning Activities"</p>
    </div>

    <!-- Mobile Image: Visible on small screens -->
    <div class="relative w-fit flex justify-start items-start md:hidden">
        <img src="{{ asset('images/together-mobile.png') }}"
            alt="Welcome"
            class="h-fit w-auto object-contain rounded-lg mask-blur px-4" />
    </div>

    <!-- Desktop Image: Visible on medium screens and above -->
    <div class="relative w-fit md:flex hidden justify-start items-start">
        <img src="{{ asset('images/together.png') }}"
            alt="Welcome"
            class="h-fit max-h-[350px] w-auto object-contain rounded-lg mask-blur" />
    </div>
</section>

<!-- Services -->
<section id="services" class="py-8 md:py-16 bg-gradient-to-b from-blue-200 to-white">
    <div class="max-w-6xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-blue-900 mb-10">Our Programs & Services</h2>
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

    <!-- See More Button -->
    <div class="text-center mt-10">
      <a href="{{ route('programs') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded font-semibold hover:bg-blue-700 transition">
        See More Programs
      </a>
    </div>
</section>

<!-- Our Teachers -->

<section id="teachers" class="py-8 md:py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-blue-900 mb-4">Meet Our Dedicated Teachers</h2>
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

<!-- Activities Preview -->
<section id="activities" class="py-8 md:py-16 bg-gradient-to-b from-white to-blue-200" x-data="previewGallery()" @keydown.escape.window="closeLightbox()">
  <div class="max-w-6xl mx-auto px-4">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-blue-900 mb-4">Student Activities</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        A glimpse into the exciting activities at PKBM Bina Abdi Wiyata — from science fairs to art workshops and community service.
      </p>
    </div>

    <!-- Preview Image Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
      <template x-for="(img, index) in images" :key="index">
        <div>
          <button
            class="group relative w-full h-40 overflow-hidden rounded-lg shadow-md focus:outline-none"
            @click="openLightbox(index)"
            type="button"
            :aria-label="'Open image ' + (index + 1)"
          >
            <img
              :src="img.thumb"
              :alt="img.alt"
              class="w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-105"
            />
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent text-white text-sm p-1 opacity-0 group-hover:opacity-100 transition-opacity">
              <span x-text="img.caption"></span>
            </div>
          </button>
        </div>
      </template>
    </div>

    <!-- See More Button -->
    <div class="text-center mt-10">
      <a href="{{ route('activities') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded font-semibold hover:bg-blue-700 transition">
        See More Activities
      </a>
    </div>

    <!-- Lightbox Modal -->
    <div
      x-show="lightboxOpen"
      style="display: none;"
      class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-200"
      @click.self="closeLightbox()"
    >
      <button
        @click="closeLightbox()"
        class="absolute top-5 right-5 text-white text-3xl font-bold focus:outline-none"
        aria-label="Close lightbox"
      >&times;</button>

      <div class="max-w-4xl max-h-[90vh]">
        <img
          :src="images[currentImage].full"
          :alt="images[currentImage].alt"
          class="rounded-lg max-w-full max-h-full mx-auto"
        />
        <p class="text-white mt-4 text-center" x-text="images[currentImage].caption"></p>
      </div>
    </div>
  </div>
</section>

<script>
  function previewGallery() {
    return {
      lightboxOpen: false,
      currentImage: 0,
      images: [
        { thumb: '/images/activities/0001 - mpls - 2024-07-15.jpeg', full: '/images/activities/0001 - mpls - 2024-07-15.jpeg', alt: 'MPLS 1', caption: 'MPLS 2024/2025' },
        { thumb: '/images/activities/0010 - hutri - 2024-08-12.jpeg', full: '/images/activities/0010 - hutri - 2024-08-12.jpeg', alt: 'HUT RI', caption: 'HUT RI 2024' },
        { thumb: '/images/activities/0014 - ptm - 2024-12-16.jpeg', full: '/images/activities/0014 - ptm - 2024-12-16.jpeg', alt: 'Tatap Muka', caption: 'Pembelajaran Tatap Muka 2024/2025' },
        { thumb: '/images/activities/0036 - raport - 2025-05-10.jpeg', full: '/images/activities/0036 - raport - 2025-05-10.jpeg', alt: 'Raker', caption: 'Pembagian Raport 2024/2025' },
      ],
      openLightbox(index) {
        this.currentImage = index;
        this.lightboxOpen = true;
      },
      closeLightbox() {
        this.lightboxOpen = false;
      }
    }
  }
</script>

