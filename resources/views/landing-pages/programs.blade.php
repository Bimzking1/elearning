<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Our Programs - Bina Abdi Wiyata</title>
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
            --gray-subtle: #f8fafc;
            --text-main:   #1e293b;
            --text-muted:  #64748b;
        }
        body { font-family: 'DM Sans', sans-serif; }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

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

        .program-card {
            transition: transform 0.3s cubic-bezier(0.34,1.4,0.64,1), box-shadow 0.3s ease;
        }
        .program-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(37,99,235,0.12);
        }

        .lightbox-backdrop {
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
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
<body class="bg-[var(--gray-subtle)] text-[var(--text-main)]">

    @include('/modular-components/multipage/navbar')

    <!-- Hero -->
    <section class="relative overflow-hidden noise-bg bg-gradient-to-b from-white via-[#eff6ff] to-[#dbeafe] py-14 px-6">
        <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[600px] h-[300px] rounded-full bg-blue-100 opacity-50 blur-3xl pointer-events-none"></div>
        <div class="relative z-10 max-w-3xl mx-auto text-center reveal">
            <h1 class="text-4xl md:text-5xl font-bold text-[var(--blue-deep)] mt-3 mb-3 leading-tight">
                Our <em class="not-italic text-[var(--blue-mid)]">Programs</em>
            </h1>
            <div class="flex justify-center mb-5"><span class="gold-rule"></span></div>
            <p class="text-base md:text-lg text-[var(--text-muted)] max-w-2xl mx-auto leading-relaxed">
                PKBM Homeschooling Bina Abdi Wiyata offers alternative education pathways through the Kejar Paket programs and Homeschooling — ensuring everyone has the opportunity to complete their education at their own pace.
            </p>
        </div>
    </section>

    <!-- Programs Grid -->
    <main class="bg-gradient-to-b from-[#dbeafe] to-white pb-14 md:pb-20"
          x-data="programPreview()"
          @keydown.escape.window="closeLightbox()">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <template x-for="(program, index) in programs" :key="index">
                    <div class="reveal program-card bg-white rounded-2xl overflow-hidden border border-[var(--blue-pale)]"
                         :style="'transition-delay:' + (index * 0.08) + 's'">
                        <div class="h-1.5 bg-gradient-to-r from-[var(--blue-mid)] to-blue-400"></div>
                        <div class="p-0">
                            <!-- Image -->
                            <button @click="openLightbox(index)"
                                    class="group relative w-full overflow-hidden focus:outline-none bg-[var(--blue-pale)]"
                                    style="aspect-ratio: 16/9;">
                                <img :src="program.thumb"
                                    :alt="program.caption"
                                    class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105"
                                    loading="lazy" />
                                <div class="absolute inset-0 bg-gradient-to-t from-[#1e3a5f]/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                    <span class="text-white text-xs font-medium" x-text="program.caption"></span>
                                </div>
                            </button>

                            <!-- Text -->
                            <div class="p-7">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h2 class="text-xl font-bold text-[var(--blue-deep)]" x-text="program.caption"></h2>
                                    </div>
                                    <div class="w-9 h-9 rounded-full bg-[var(--blue-pale)] flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-[var(--blue-mid)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z"/>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-sm text-[var(--text-muted)] leading-relaxed" x-text="descriptions[index]"></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Lightbox -->
        <div x-show="lightboxOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             style="display:none;"
             class="lightbox-backdrop fixed inset-0 bg-[#0f1f3d]/85 flex items-center justify-center z-[200]"
             @click.self="closeLightbox()">
            <button @click="closeLightbox()"
                    class="absolute top-5 right-6 text-white/70 hover:text-white text-4xl font-light focus:outline-none transition-colors">&times;</button>
            <div class="max-w-3xl max-h-[85vh] px-6">
                <img :src="programs[currentImage].full" :alt="programs[currentImage].caption"
                     class="rounded-2xl max-w-full max-h-[78vh] mx-auto shadow-2xl object-contain"/>
                <p class="text-white/70 mt-4 text-center text-sm tracking-wide" x-text="programs[currentImage].caption"></p>
            </div>
        </div>
    </main>

    @include('/modular-components/multipage/footer')

    <script>
        function programPreview() {
            return {
                lightboxOpen: false,
                currentImage: 0,
                programs: [
                    { thumb: '/images/activities/0037%20-%20anbk-a%20-%202024-10-14.jpeg', full: '/images/activities/0037%20-%20anbk-a%20-%202024-10-14.jpeg', caption: 'Kejar Paket A (Setara SD)' },
                    { thumb: '/images/activities/0045%20-%20anbk-b%20-%202024-09-05.jpeg', full: '/images/activities/0045%20-%20anbk-b%20-%202024-09-05.jpeg', caption: 'Kejar Paket B (Setara SMP)' },
                    { thumb: '/images/activities/0015%20-%20ptm%20-%202024-12-16.jpeg',     full: '/images/activities/0015%20-%20ptm%20-%202024-12-16.jpeg',     caption: 'Kejar Paket C (Setara SMA)' },
                    { thumb: '/images/activities/homeschool.jpg',                            full: '/images/activities/homeschool.jpg',                            caption: 'Homeschooling' }
                ],
                descriptions: [
                    'A basic education program for school-age children and adults who have not completed elementary school. The curriculum follows national standards with an emphasis on literacy, numeracy, character building, and basic life skills.',
                    'A lower secondary education program for graduates of Paket A or elementary school. The material focuses on developing foundational knowledge, logic, and practical skills for daily life.',
                    'An upper secondary education program for learners who have completed Paket B or junior high school. Designed to prepare students for the workforce or higher education, with a flexible learning schedule.',
                    'A flexible learning system conducted from home with professional tutor support. Suitable for students with special needs, busy schedules, or those seeking a personalized learning approach.'
                ],
                openLightbox(index) { this.currentImage = index; this.lightboxOpen = true; },
                closeLightbox()     { this.lightboxOpen = false; }
            };
        }

        document.addEventListener('DOMContentLoaded', function () {
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
        });
    </script>
</body>
</html>