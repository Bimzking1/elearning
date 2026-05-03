<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Admission - Bina Abdi Wiyata</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue-deep:   #1e3a5f;
            --blue-mid:    #2563eb;
            --blue-soft:   #3b82f6;
            --blue-pale:   #dbeafe;
            --blue-ghost:  #eff6ff;
            --gold:        #c9a84c;
            --text-main:   #1e293b;
            --text-muted:  #64748b;
        }
        body { font-family: 'DM Sans', sans-serif; }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .section-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--blue-soft);
        }
        .gold-rule {
            display: inline-block;
            width: 3rem;
            height: 2px;
            background: linear-gradient(90deg, var(--gold), transparent);
            border-radius: 999px;
        }
        @keyframes pulse-cta {
            0%, 100% { transform: scale(1); box-shadow: 0 4px 6px rgba(37,99,235,0.5); }
            50%       { transform: scale(1.04); box-shadow: 0 6px 14px rgba(29,78,216,0.7); }
        }
        .animate-cta { animation: pulse-cta 2s infinite ease-in-out; }

        .info-card {
            background: white;
            border: 1px solid var(--blue-pale);
            border-radius: 1rem;
            padding: 1.75rem;
            transition: transform 0.3s cubic-bezier(0.34,1.4,0.64,1), box-shadow 0.3s ease;
        }
        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(37,99,235,0.1);
        }
        .noise-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 0;
        }
    </style>
</head>
<body class="bg-[var(--blue-ghost)] text-[var(--text-main)]">

    @include('/modular-components/multipage/navbar')

    <!-- Hero Banner -->
    <section class="relative overflow-hidden noise-bg bg-gradient-to-b from-white via-[#eff6ff] to-[#dbeafe] pt-6 md:pt-10 pb-6 px-6">
        <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[600px] h-[300px] rounded-full bg-blue-100 opacity-50 blur-3xl pointer-events-none"></div>
        <div class="relative z-10 max-w-3xl mx-auto text-center reveal">

            <!-- Admission Banner Image — 4:1 ratio to match ~20000x5000 -->
            <div class="relative left-1/2 -translate-x-1/2 mb-8 w-[90vw] max-w-7xl"
                style="aspect-ratio: 4 / 1;">
                <img src="{{ asset('images/admission_26-27.webp') }}"
                    alt="Student Admission 2026–2027"
                    class="w-full h-full object-cover object-center" />
            </div>

            <span class="section-label">Join Us</span>
            <h1 class="text-4xl md:text-5xl font-bold text-[var(--blue-deep)] mt-3 mb-3 leading-tight">
                New Student<br><em class="not-italic text-[var(--blue-mid)]">Admission</em>
            </h1>
            <div class="flex justify-center mb-5"><span class="gold-rule"></span></div>
            <p class="text-base md:text-lg text-[var(--text-muted)] max-w-xl mx-auto leading-relaxed mb-8">
                Register now to join us at PKBM Homeschooling Bina Abdi Wiyata. Flexible, quality education with official certification awaits you.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                
                <!-- Register Button -->
                <a href="https://intip.in/PendaftaranPKBMBAWSBY" target="_blank"
                class="animate-cta inline-flex items-center justify-center gap-2 bg-[var(--blue-mid)] text-white px-8 py-4 rounded-xl font-semibold text-base shadow-lg hover:bg-blue-700 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Register Now
                </a>

                <!-- WhatsApp Button -->
                <a href="https://wa.me/6281231166033" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center justify-center gap-2 bg-green-500 text-white px-8 py-4 rounded-xl font-semibold text-base shadow-lg hover:bg-green-600 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.52 3.48A11.82 11.82 0 0012.05 0C5.54 0 .28 5.27.28 11.77c0 2.07.54 4.1 1.56 5.9L0 24l6.52-1.7a11.77 11.77 0 005.53 1.4h.01c6.5 0 11.77-5.27 11.77-11.77 0-3.14-1.22-6.09-3.31-8.18zM12.06 21.3c-1.8 0-3.57-.48-5.12-1.38l-.37-.22-3.87 1.01 1.03-3.77-.24-.39a9.22 9.22 0 01-1.42-4.88c0-5.1 4.15-9.25 9.25-9.25 2.47 0 4.79.96 6.54 2.71a9.2 9.2 0 012.71 6.54c0 5.1-4.15 9.25-9.25 9.25zm5.07-6.93c-.28-.14-1.65-.81-1.9-.9-.26-.1-.44-.14-.63.14-.18.28-.72.9-.88 1.09-.16.18-.32.21-.6.07-.28-.14-1.17-.43-2.23-1.37-.82-.73-1.37-1.63-1.53-1.9-.16-.28-.02-.43.12-.57.13-.13.28-.32.42-.49.14-.16.18-.28.28-.46.09-.18.05-.35-.02-.49-.07-.14-.63-1.53-.86-2.1-.23-.56-.46-.48-.63-.49h-.54c-.18 0-.49.07-.75.35-.26.28-1 1-1 2.44 0 1.44 1.02 2.83 1.16 3.03.14.21 2.01 3.07 4.87 4.3.68.29 1.21.46 1.62.59.68.22 1.3.19 1.79.12.55-.08 1.65-.67 1.88-1.32.23-.65.23-1.2.16-1.32-.07-.12-.26-.18-.54-.32z"/>
                    </svg>
                    WhatsApp
                </a>

            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="relative bg-gradient-to-b from-[#dbeafe] to-white pb-14 pt-8 md:pb-20">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">

                <!-- Left: Info -->
                <div class="space-y-6 reveal">
                    <div class="info-card">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-[var(--blue-pale)] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[var(--blue-mid)]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-[var(--blue-deep)] text-base">Officially Accredited — Grade A</h3>
                        </div>
                        <p class="text-sm text-[var(--text-muted)] leading-relaxed">Licensed by the Ministry of Education and the Surabaya Education Department, with an "A" accreditation rating.</p>
                    </div>

                    <div class="info-card">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-[var(--blue-pale)] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[var(--blue-mid)]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-[var(--blue-deep)] text-base">Flexible, Personalized Learning</h3>
                        </div>
                        <p class="text-sm text-[var(--text-muted)] leading-relaxed">Learn at your own pace — online, self-paced, or in-person — tailored to fit your schedule and lifestyle.</p>
                    </div>

                    <div class="info-card">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-[var(--blue-pale)] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[var(--blue-mid)]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-[var(--blue-deep)] text-base">Pathway to Higher Education</h3>
                        </div>
                        <p class="text-sm text-[var(--text-muted)] leading-relaxed">Our graduates are well-prepared to continue at public or private schools, universities, and professional programs.</p>
                    </div>

                    <div class="pt-2">
                        <a href="https://intip.in/PendaftaranPKBMBAWSBY" target="_blank"
                           class="animate-cta inline-flex items-center justify-center gap-2 bg-[var(--blue-mid)] text-white px-8 py-4 rounded-xl font-semibold text-base shadow-lg hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Register Now
                        </a>
                    </div>
                </div>

                <!-- Right: Image -->
                <div class="flex justify-center reveal" style="transition-delay:0.15s">
                    <img src="{{ asset('images/register.webp') }}"
                         alt="Register Illustration"
                         class="rounded-2xl w-full md:w-[520px] object-cover" />
                </div>
            </div>
        </div>
    </main>

    @include('/modular-components/multipage/footer')

    <script>
        const revealEls = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
            });
        }, { threshold: 0.1 });
        revealEls.forEach(el => observer.observe(el));
    </script>

    <!-- Mobile-only banner popup (triggered by clicking the banner image) -->
    <div id="reg-admission-popup"
        class="fixed inset-0 z-[300] flex items-center justify-center bg-black/70"
        style="display:none !important; backdrop-filter:blur(6px); -webkit-backdrop-filter:blur(6px);">

        <!-- Backdrop -->
        <div class="absolute inset-0 cursor-pointer" onclick="closeRegPopup()"></div>

        <!-- Portrait image -->
        <div class="relative px-4 w-full max-w-sm mx-auto flex flex-col justify-center items-center">
            <img src="{{ asset('images/banner-potrait.webp') }}"
                alt="Student Admission 2026–2027"
                class="w-auto h-[85vh] rounded-2xl shadow-2xl"
                onclick="closeRegPopup()" />

            <button onclick="closeRegPopup()"
                    class="absolute -top-3 -right-1 w-8 h-8 rounded-full bg-white/90 text-[#1e3a5f] flex items-center justify-center shadow-md text-lg font-bold hover:bg-white transition-colors"
                    aria-label="Close">
                &times;
            </button>

            <!-- Action bar -->
            <div class="mt-3 flex items-center justify-center gap-3">

                <!-- Share / Copy link -->
                <button id="popup-share-btn"
                        onclick="handlePopupShare()"
                        class="flex items-center gap-2 bg-white/90 text-[#1e3a5f] text-xs font-semibold
                            px-4 py-2.5 rounded-xl shadow-md hover:bg-white active:scale-95
                            transition-all duration-150 backdrop-blur-sm border border-white/60">
                    <svg id="popup-share-icon" class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    <span id="popup-share-label">Share Link</span>
                </button>

                <!-- Download -->
                <a href="{{ asset('images/banner-potrait.webp') }}"
                download="PKBM-BAW-Admission-2026-27.webp"
                class="flex items-center gap-2 bg-[#1e3a5f] text-white text-xs font-semibold
                        px-4 py-2.5 rounded-xl shadow-md hover:bg-[#162d4a] active:scale-95
                        transition-all duration-150">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Save Banner
                </a>

            </div>
        </div>
    </div>

    <script>
        (function () {
            // Only wire up on mobile
            if (window.innerWidth >= 768) return;

            const popup  = document.getElementById('reg-admission-popup');
            const banner = document.querySelector('section img[alt="Student Admission 2026–2027"]');

            if (!banner) return;

            // Make banner feel clickable on mobile
            banner.style.cursor = 'pointer';
            banner.parentElement.style.cursor = 'pointer';

            banner.addEventListener('click', openRegPopup);
            banner.parentElement.addEventListener('click', openRegPopup);

            function openRegPopup() {
                popup.style.removeProperty('display');
                popup.style.opacity = '0';
                popup.style.transition = 'opacity 0.35s ease';
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => { popup.style.opacity = '1'; });
                });
                document.body.style.overflow = 'hidden';
            }

            window.closeRegPopup = function () {
                popup.style.opacity = '0';
                setTimeout(() => {
                    popup.style.display = 'none';
                    document.body.style.overflow = '';
                }, 350);
            };

            window.handlePopupShare = function () {
                const url = 'https://binaabdiwiyata.id/register';
                const label = document.getElementById('popup-share-label');
                const icon  = document.getElementById('popup-share-icon');

                // Try native share sheet first (most mobile browsers support it)
                if (navigator.share) {
                    navigator.share({
                        title: 'PKBM Bina Abdi Wiyata — Student Admission 2026/2027',
                        text:  'Daftar sekarang di PKBM Homeschooling Bina Abdi Wiyata!',
                        url:   url,
                    }).catch(() => {}); // user cancelled — ignore
                    return;
                }

                // Fallback: copy to clipboard
                navigator.clipboard.writeText(url).then(() => {
                    // Swap to checkmark feedback
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>';
                    label.textContent = 'Copied!';
                    setTimeout(() => {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>';
                        label.textContent = 'Share Link';
                    }, 2000);
                }).catch(() => {});
            };
    })();
    </script>

</body>
</html>