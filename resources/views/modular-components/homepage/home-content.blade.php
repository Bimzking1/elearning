{{-- ============================================================
     home-content.blade.php  — PKBM Bina Abdi Wiyata
     Elegant blue-white theme, refined typography & micro-interactions
     ============================================================ --}}

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap');

    :root {
        --blue-deep:   #1e3a5f;
        --blue-mid:    #2563eb;
        --blue-soft:   #3b82f6;
        --blue-pale:   #dbeafe;
        --blue-ghost:  #eff6ff;
        --gold:        #c9a84c;
        --white:       #ffffff;
        --gray-subtle: #f8fafc;
        --text-main:   #1e293b;
        --text-muted:  #64748b;
    }

    /* Base font override for homepage sections */
    .pkbm-page { font-family: 'DM Sans', sans-serif; }

    /* Section fade-up on scroll */
    .reveal {
        opacity: 0;
        transform: translateY(28px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Admission banner shimmer */
    @keyframes shimmer {
        0%   { background-position: -400px 0; }
        100% { background-position: 400px 0; }
    }
    .admission-shimmer::after {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 1rem;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(255,255,255,0.35) 70%,
            transparent 100%);
        background-size: 800px 100%;
        animation: shimmer 2.8s infinite linear;
        pointer-events: none;
    }

    /* Decorative section divider */
    .section-label {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--blue-soft);
    }

    /* Card hover lift */
    .program-card {
        transition: transform 0.3s cubic-bezier(0.34,1.4,0.64,1), box-shadow 0.3s ease;
    }
    .program-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(37,99,235,0.12);
    }

    /* Teacher avatar ring */
    .teacher-avatar {
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .teacher-avatar:hover {
        box-shadow: 0 0 0 4px #93c5fd, 0 8px 24px rgba(37,99,235,0.2);
        transform: scale(1.05);
    }

    /* Gold accent line */
    .gold-rule {
        display: inline-block;
        width: 3rem;
        height: 2px;
        background: linear-gradient(90deg, var(--gold), transparent);
        border-radius: 999px;
    }

    /* Soft glow pulse for admission */
    @keyframes glowPulse {
        0%, 100% { box-shadow: 0 0 20px 4px rgba(37,99,235,0.18); }
        50%       { box-shadow: 0 0 40px 12px rgba(37,99,235,0.32); }
    }
    .admission-glow {
        animation: glowPulse 2.4s ease-in-out infinite;
    }

    /* Subtle noise texture overlay */
    .noise-bg::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
        pointer-events: none;
        z-index: 0;
    }

    /* Why-us feature icon */
    .feature-icon {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.6rem;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-bottom: 0.75rem;
    }

    /* Lightbox backdrop blur */
    .lightbox-backdrop {
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
    }
</style>

<div class="pkbm-page">

{{-- ─────────────────────────────────────────────────────────
     ADMISSION BANNER
───────────────────────────────────────────────────────── --}}
<section class="relative overflow-hidden bg-gradient-to-b from-[#eff6ff] to-white pt-6 pb-4 px-6 md:py-10 text-center">
    <!-- Subtle decorative orb -->
    <div class="absolute -top-16 left-1/2 -translate-x-1/2 w-[500px] h-[300px] rounded-full bg-blue-100 opacity-50 blur-3xl pointer-events-none"></div>

    <div class="relative inline-block">
        <a href="{{ route('register') }}"
           class="admission-shimmer admission-glow relative block rounded-2xl overflow-hidden group">
            <img
                src="{{ asset('images/admission_26-27.webp') }}"
                alt="Student Admission 2026–2027"
                class="relative mx-auto max-h-48 md:max-h-72 lg:max-h-84 w-auto object-contain rounded-2xl
                       transition-transform duration-500 group-hover:scale-[1.04]"
            />
        </a>
    </div>
</section>

{{-- ─────────────────────────────────────────────────────────
     HYBRID LEARNING HERO
───────────────────────────────────────────────────────── --}}
<section class="relative overflow-hidden noise-bg bg-gradient-to-b from-white via-[#eff6ff] to-[#dbeafe] text-[var(--blue-deep)] pb-16 pt-8 md:pb-24 md:pt-4">
    <div class="relative z-10 container mx-auto flex flex-col md:flex-row items-center justify-center px-6 gap-12 md:gap-16">

        <!-- Text -->
        <div class="w-full md:w-1/2 flex flex-col items-start md:items-end text-left md:text-right reveal">
            <h2 class="pkbm-display text-5xl md:text-6xl lg:text-7xl font-bold mb-5 leading-[1.1] text-[var(--blue-deep)]">
                Hybrid<br><em class="not-italic text-[var(--blue-mid)]">Learning</em>
            </h2>
            <div class="flex md:justify-end mb-5">
                <span class="gold-rule"></span>
            </div>
            <p class="text-base md:text-lg mb-3 leading-relaxed text-[var(--text-muted)] max-w-md">
                PKBM Homeschooling Bina Abdi Wiyata, a trusted institution with years of experience and an <strong class="text-[var(--blue-deep)] font-semibold">A-level accreditation</strong>.
            </p>
            <p class="text-base md:text-lg mb-3 leading-relaxed text-[var(--text-muted)] max-w-md">
                Flexible and adaptive learning, tailored to each student anytime, anywhere, guided by dedicated educators.
            </p>
            <p class="text-base md:text-lg mb-8 leading-relaxed text-[var(--text-muted)] max-w-md">
                Help your child grow to their full potential and achieve a limitless future.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <a href="{{ route('register') }}"
                   class="animate-cta inline-flex items-center justify-center gap-2 bg-[var(--blue-mid)] text-white px-7 py-3.5 rounded-xl font-semibold text-base shadow-lg hover:bg-blue-700 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Student Admission
                </a>
                <a href="{{ route('login') }}"
                   class="inline-flex items-center justify-center gap-2 bg-[var(--blue-deep)] text-white px-7 py-3.5 rounded-xl font-semibold text-base shadow-md hover:bg-blue-900 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14"/></svg>
                    Login
                </a>
            </div>
            <a href="{{ route('contact') }}"
               class="mt-3 inline-flex items-center gap-1.5 text-sm text-[var(--blue-soft)] hover:text-[var(--blue-deep)] font-medium transition-colors duration-200 group">
                <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                Contact Us
            </a>
        </div>

        <!-- Image -->
        <div class="w-full md:w-1/2 flex justify-center reveal" style="transition-delay: 0.15s;">
            <img src="{{ asset('images/welcome-merged.webp') }}"
                 alt="Welcome"
                 class="h-auto md:h-[440px] w-auto object-contain drop-shadow-xl" />
        </div>
    </div>
</section>

{{-- ─────────────────────────────────────────────────────────
     ABOUT US
───────────────────────────────────────────────────────── --}}
<section id="about" class="relative py-16 md:py-24 bg-gradient-to-b from-[#dbeafe] to-white">
    <div class="max-w-3xl mx-auto px-6 text-center reveal">
        <span class="section-label">Who We Are</span>
        <h2 class="pkbm-display text-3xl md:text-4xl font-bold text-[var(--blue-deep)] mt-3 mb-2">
            About PKBM Homeschooling Bina Abdi Wiyata
        </h2>
        <div class="flex justify-center mb-6"><span class="gold-rule"></span></div>
        <p class="text-base md:text-lg text-[var(--text-muted)] leading-relaxed mb-4">
            PKBM Homeschooling Bina Abdi Wiyata is a Community Learning Center providing non-formal education programs — Kejar Paket A, B, and C — as well as flexible, personalized homeschooling services. Our mission is to offer educational opportunities to individuals of all ages and backgrounds seeking to continue or complete their education outside the formal system.
        </p>
        <p class="text-base md:text-lg text-[var(--text-muted)] leading-relaxed mb-4">
            Founded on the principles of inclusion and empowerment, we believe education is a fundamental right for everyone — regardless of age, economic status, or past experience. Our learner-centered approaches are aligned with the national curriculum and tailored to each student's needs.
        </p>
        <p class="text-base md:text-lg text-[var(--text-muted)] leading-relaxed">
            Our homeschooling program offers flexible scheduling, personalized learning plans, academic support, and preparation for national examinations — all under the guidance of experienced educators.
        </p>
    </div>
</section>

{{-- ─────────────────────────────────────────────────────────
     WHY CHOOSE US
───────────────────────────────────────────────────────── --}}
<section id="why" class="py-16 md:py-24 bg-[var(--gray-subtle)]">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-14 reveal">
            <span class="section-label">Our Strengths</span>
            <h2 class="pkbm-display text-3xl md:text-4xl font-bold text-[var(--blue-deep)] mt-3 mb-2">
                Why Choose Us
            </h2>
            <div class="flex justify-center"><span class="gold-rule"></span></div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            @php
            $features = [
                ['icon'=>'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'title'=>'Officially Registered & Accredited', 'body'=>'Licensed by the Ministry of Education and the Surabaya Education Department, and accredited with an "A" rating as a trusted non-formal education institution.'],
                ['icon'=>'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'title'=>'Proven Track Record', 'body'=>'For over a decade, we have supported students in achieving accolades at local, regional, and national levels.'],
                ['icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'title'=>'Flexible Learning System', 'body'=>'Learn when, where, and how you want — self-paced, online, private, and community-based learning options tailored to each student.'],
                ['icon'=>'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title'=>'Modern LMS Platform', 'body'=>'Our Learning Management System makes studying more interactive, enjoyable, and well-structured for every student.'],
                ['icon'=>'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z', 'title'=>'Pathways to Higher Education', 'body'=>'Our students are well-prepared to continue their studies at public or private schools and universities.'],
                ['icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'title'=>'Experienced & Dedicated Team', 'body'=>'Run by certified educators and graduates from top universities, committed to delivering quality, personalized education.'],
            ];
            @endphp

            @foreach($features as $i => $f)
            <div class="reveal bg-white rounded-2xl p-7 border border-[var(--blue-pale)] program-card"
                 style="transition-delay: {{ $i * 0.07 }}s">
                <div class="feature-icon">
                    <svg class="w-5 h-5 text-[var(--blue-mid)]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['icon'] }}"/>
                    </svg>
                </div>
                <h4 class="text-base font-semibold text-[var(--blue-deep)] mb-2">{{ $f['title'] }}</h4>
                <p class="text-sm text-[var(--text-muted)] leading-relaxed">{{ $f['body'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ─────────────────────────────────────────────────────────
     MOTTO
───────────────────────────────────────────────────────── --}}
<section id="motto" class="relative overflow-hidden py-16 md:py-24 bg-gradient-to-b from-white to-[#dbeafe] flex flex-col justify-center items-center">
    <!-- Decorative circles -->
    <div class="absolute top-0 right-0 w-64 h-64 rounded-full bg-blue-100 opacity-40 blur-2xl pointer-events-none -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 rounded-full bg-blue-200 opacity-30 blur-2xl pointer-events-none translate-y-1/3 -translate-x-1/4"></div>

    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center reveal">
        <span class="section-label">Our Guiding Principle</span>
        <h2 class="pkbm-display text-3xl md:text-4xl font-bold text-[var(--blue-deep)] mt-3 mb-4">Our Motto</h2>
        <div class="flex justify-center mb-6"><span class="gold-rule"></span></div>
        <blockquote class="pkbm-display text-xl md:text-2xl italic text-[var(--blue-mid)] leading-relaxed">
            "A Life-improving Centre for Community Learning Activities"
        </blockquote>
    </div>

    <div class="relative z-10 mt-8 reveal" style="transition-delay:0.2s">
        <!-- Mobile -->
        <img src="{{ asset('images/together-mobile.webp') }}"
             alt="Together"
             class="md:hidden h-auto w-auto object-contain rounded-2xl mask-blur px-4 max-h-72" />
        <!-- Desktop -->
        <img src="{{ asset('images/together.webp') }}"
             alt="Together"
             class="hidden md:block max-h-[340px] w-auto object-contain rounded-2xl mask-blur" />
    </div>
</section>

{{-- ─────────────────────────────────────────────────────────
     PROGRAMS & SERVICES
───────────────────────────────────────────────────────── --}}
<section id="services" class="py-16 md:py-24 bg-gradient-to-b from-[#dbeafe] to-white">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-14 reveal">
            <span class="section-label">What We Offer</span>
            <h2 class="pkbm-display text-3xl md:text-4xl font-bold text-[var(--blue-deep)] mt-3 mb-2">
                Programs &amp; Services
            </h2>
            <div class="flex justify-center"><span class="gold-rule"></span></div>
        </div>

        @php
        $programs = [
            ['level'=>'Paket A', 'sub'=>'Setara SD', 'desc'=>'A foundational education program for learners seeking an elementary school equivalent certification, aligned with national curriculum standards.', 'color'=>'from-blue-50 to-blue-100'],
            ['level'=>'Paket B', 'sub'=>'Setara SMP', 'desc'=>'A middle school equivalent program focused on core competencies and life skills for learners continuing their academic journey.', 'color'=>'from-blue-50 to-blue-100'],
            ['level'=>'Paket C', 'sub'=>'Setara SMA', 'desc'=>'A high school level program preparing students for an SMA-equivalent diploma and pathways to higher education or employment.', 'color'=>'from-blue-50 to-blue-100'],
            ['level'=>'Homeschooling', 'sub'=>'Belajar Mandiri', 'desc'=>'Flexible home-based learning under the guidance of educators, following the national curriculum with personalized scheduling.', 'color'=>'from-blue-50 to-blue-100'],
        ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($programs as $i => $p)
            <div class="reveal program-card bg-white rounded-2xl overflow-hidden border border-[var(--blue-pale)] group"
                 style="transition-delay: {{ $i * 0.08 }}s">
                <div class="h-1.5 bg-gradient-to-r from-[var(--blue-mid)] to-blue-400"></div>
                <div class="p-7">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h3 class="pkbm-display text-xl font-bold text-[var(--blue-deep)]">{{ $p['level'] }}</h3>
                            <span class="text-xs text-[var(--blue-soft)] font-medium tracking-wide uppercase">{{ $p['sub'] }}</span>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-[var(--blue-pale)] flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-[var(--blue-mid)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-[var(--text-muted)] leading-relaxed">{{ $p['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10 reveal" style="transition-delay:0.3s">
            <a href="{{ route('programs') }}"
               class="inline-flex items-center gap-2 bg-[var(--blue-mid)] text-white px-7 py-3.5 rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors duration-200 shadow-md">
                Explore All Programs
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ─────────────────────────────────────────────────────────
     OUR TEACHERS
───────────────────────────────────────────────────────── --}}
<section id="teachers" class="py-16 md:py-24 bg-[var(--gray-subtle)]">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-14 reveal">
            <span class="section-label">The People Behind the Mission</span>
            <h2 class="pkbm-display text-3xl md:text-4xl font-bold text-[var(--blue-deep)] mt-3 mb-2">
                Meet Our Dedicated Teachers
            </h2>
            <div class="flex justify-center mb-6"><span class="gold-rule"></span></div>
            <p class="text-base text-[var(--text-muted)] leading-relaxed max-w-2xl mx-auto">
                Passionate educators committed to guiding students toward success. With diverse academic backgrounds, real-world experience, and a heart for teaching, our team creates a supportive, engaging learning environment tailored to each student's needs.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-10" id="teacher-row-1">
            @php
            $teachers = [
                ['name'=>'Drs. Lukas Kambali, S.H., M.H.', 'subject'=>'Geografi', 'img'=>'lukas-kambali.jpg'],
                ['name'=>'Albert Kurniawan, S.T.', 'subject'=>'Fisika, Biologi, Kimia', 'img'=>'albert-kurniawan.jpg'],
                ['name'=>'L. Williyan Putra Perdana, S.E., M.M.', 'subject'=>'Ekonomi', 'img'=>'williyan.jpg'],
            ];
            @endphp

            @foreach($teachers as $i => $t)
            <div class="reveal flex flex-col items-center text-center" style="transition-delay: {{ $i * 0.1 }}s">
                <img class="teacher-avatar w-32 h-32 object-cover rounded-full mb-4 border-2 border-[var(--blue-pale)] shadow-md"
                     src="{{ asset('images/' . $t['img']) }}"
                     alt="{{ $t['name'] }}">
                <h3 class="pkbm-display text-lg font-bold text-[var(--blue-deep)] leading-snug mb-1">{{ $t['name'] }}</h3>
                <p class="text-xs text-[var(--blue-soft)] font-medium tracking-wide uppercase">{{ $t['subject'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ─────────────────────────────────────────────────────────
     STUDENT ACTIVITIES
───────────────────────────────────────────────────────── --}}
<section id="activities"
         class="py-16 md:py-24 bg-gradient-to-b from-white to-[#dbeafe]"
         x-data="previewGallery()"
         @keydown.escape.window="closeLightbox()">
    <div class="max-w-5xl mx-auto px-6">

        <div class="text-center mb-12 reveal">
            <span class="section-label">School Environment</span>
            <h2 class="pkbm-display text-3xl md:text-4xl font-bold text-[var(--blue-deep)] mt-3 mb-2">
                Student Activities
            </h2>
            <div class="flex justify-center mb-4"><span class="gold-rule"></span></div>
            <p class="text-base text-[var(--text-muted)] max-w-xl mx-auto">
                A glimpse into life at PKBM Homeschooling Bina Abdi Wiyata — from lessons and exams to fun activities.
            </p>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            <template x-for="(img, index) in images" :key="index">
                <button
                    class="group relative w-full h-40 overflow-hidden rounded-xl shadow-sm focus:outline-none border border-[var(--blue-pale)] hover:border-[var(--blue-soft)] transition-colors duration-200"
                    @click="openLightbox(index)"
                    type="button"
                    :aria-label="'Open image ' + (index + 1)"
                >
                    <img
                        :src="img.thumb"
                        :alt="img.alt"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1e3a5f]/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3">
                        <span class="text-white text-xs font-medium" x-text="img.caption"></span>
                    </div>
                </button>
            </template>
        </div>

        <div class="text-center mt-10 reveal">
            <a href="{{ route('activities') }}"
               class="inline-flex items-center gap-2 bg-[var(--blue-mid)] text-white px-7 py-3.5 rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors duration-200 shadow-md">
                See All Activities
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <!-- Lightbox -->
        <div
            x-show="lightboxOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            style="display:none;"
            class="lightbox-backdrop fixed inset-0 bg-[#0f1f3d]/85 flex items-center justify-center z-[200]"
            @click.self="closeLightbox()"
        >
            <button @click="closeLightbox()"
                    class="absolute top-5 right-6 text-white/70 hover:text-white text-4xl font-light focus:outline-none transition-colors"
                    aria-label="Close">&times;</button>

            <!-- Prev -->
            <button @click="currentImage = (currentImage - 1 + images.length) % images.length"
                    class="absolute left-4 text-white/60 hover:text-white focus:outline-none transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>

            <div class="max-w-3xl max-h-[85vh] px-12">
                <img :src="images[currentImage].full"
                     :alt="images[currentImage].alt"
                     class="rounded-2xl max-w-full max-h-[78vh] mx-auto shadow-2xl object-contain" />
                <p class="text-white/70 mt-4 text-center text-sm tracking-wide" x-text="images[currentImage].caption"></p>
            </div>

            <!-- Next -->
            <button @click="currentImage = (currentImage + 1) % images.length"
                    class="absolute right-4 text-white/60 hover:text-white focus:outline-none transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>
</section>

</div>{{-- end .pkbm-page --}}

<script>
  function previewGallery() {
    return {
      lightboxOpen: false,
      currentImage: 0,
      images: @if(isset($homepageImages) && $homepageImages->isNotEmpty())
        {!! $homepageImages->map(fn($img) => [
          'thumb'   => asset('storage/' . $img->image_path),
          'full'    => asset('storage/' . $img->image_path),
          'alt'     => e($img->title),
          'caption' => e($img->title),
        ])->values()->toJson() !!}
      @else
        [
          { thumb: '/images/activities/0001 - mpls - 2024-07-15.jpeg', full: '/images/activities/0001 - mpls - 2024-07-15.jpeg', alt: 'MPLS 1', caption: 'MPLS 2024/2025' },
          { thumb: '/images/activities/0010 - hutri - 2024-08-12.jpeg', full: '/images/activities/0010 - hutri - 2024-08-12.jpeg', alt: 'HUT RI', caption: 'HUT RI 2024' },
          { thumb: '/images/activities/0014 - ptm - 2024-12-16.jpeg', full: '/images/activities/0014 - ptm - 2024-12-16.jpeg', alt: 'Tatap Muka', caption: 'Pembelajaran Tatap Muka 2024/2025' },
          { thumb: '/images/activities/0036 - raport - 2025-05-10.jpeg', full: '/images/activities/0036 - raport - 2025-05-10.jpeg', alt: 'Raker', caption: 'Pembagian Raport 2024/2025' },
        ]
      @endif,
      openLightbox(index) {
        this.currentImage = index;
        this.lightboxOpen = true;
      },
      closeLightbox() {
        this.lightboxOpen = false;
      }
    }
  }

  // Scroll-reveal
  const revealEls = document.querySelectorAll('.reveal');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.1 });
  revealEls.forEach(el => observer.observe(el));
</script>