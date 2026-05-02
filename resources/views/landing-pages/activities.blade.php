<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Activities - Bina Abdi Wiyata</title>
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
    <section class="relative overflow-hidden noise-bg bg-gradient-to-b from-white via-[#eff6ff] to-[#dbeafe] pt-14 px-6">
        <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[600px] h-[300px] rounded-full bg-blue-100 opacity-50 blur-3xl pointer-events-none"></div>
        <div class="relative z-10 max-w-3xl mx-auto text-center reveal">
            <h1 class="text-4xl md:text-5xl font-bold text-[var(--blue-deep)] mt-3 mb-3 leading-tight">
                School <em class="not-italic text-[var(--blue-mid)]">Activities</em>
            </h1>
            <div class="flex justify-center mb-5"><span class="gold-rule"></span></div>
            <p class="text-base md:text-lg text-[var(--text-muted)] max-w-2xl mx-auto leading-relaxed">
                Explore the vibrant activities at PKBM Homeschooling Bina Abdi Wiyata — showcasing our students' achievements, events, and community involvement.
            </p>
        </div>
    </section>

    <!-- Gallery -->
    <main class="bg-gradient-to-b from-[#dbeafe] to-white py-14">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <section x-data="gallery()" @keydown.escape.window="closeLightbox()">

                <!-- Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 reveal">
                    <template x-for="(img, index) in images" :key="index">
                        <button
                            class="group relative w-full h-40 overflow-hidden rounded-xl shadow-sm focus:outline-none border border-[var(--blue-pale)] hover:border-[var(--blue-soft)] transition-colors duration-200"
                            @click="openLightbox(index)"
                            type="button"
                            :aria-label="'Open image ' + (index + 1)">
                            <img :src="img.thumb" :alt="img.alt" loading="lazy"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-[#1e3a5f]/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3">
                                <span class="text-white text-xs font-medium" x-text="img.caption"></span>
                            </div>
                        </button>
                    </template>
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

                    <button @click="currentImage = (currentImage - 1 + images.length) % images.length"
                            class="absolute left-4 text-white/60 hover:text-white focus:outline-none transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </button>

                    <div class="max-w-3xl max-h-[85vh] px-12">
                        <img :src="images[currentImage].full" :alt="images[currentImage].alt"
                             class="rounded-2xl max-w-full max-h-[78vh] mx-auto shadow-2xl object-contain"/>
                        <p class="text-white/70 mt-4 text-center text-sm tracking-wide" x-text="images[currentImage].caption"></p>
                    </div>

                    <button @click="currentImage = (currentImage + 1) % images.length"
                            class="absolute right-4 text-white/60 hover:text-white focus:outline-none transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </section>
        </div>
    </main>

    @include('/modular-components/multipage/footer')

    <script>
        function gallery() {
            return {
                lightboxOpen: false,
                currentImage: 0,
                images: @if($dbImages->isNotEmpty())
                    {!! $dbImages->map(fn($img) => [
                        'thumb'   => asset('storage/' . $img->image_path),
                        'full'    => asset('storage/' . $img->image_path),
                        'alt'     => e($img->title),
                        'caption' => e($img->title),
                        'pinned'  => $img->is_pinned,
                    ])->values()->toJson() !!}
                @else
                    [
                        { thumb: '/images/activities/0001 - mpls - 2024-07-15.jpeg', full: '/images/activities/0001 - mpls - 2024-07-15.jpeg', alt: 'MPLS 1', caption: 'MPLS 2024/2025', pinned: false },
                        { thumb: '/images/activities/0010 - hutri - 2024-08-12.jpeg', full: '/images/activities/0010 - hutri - 2024-08-12.jpeg', alt: 'HUT RI', caption: 'HUT RI 2024', pinned: false },
                        { thumb: '/images/activities/0014 - ptm - 2024-12-16.jpeg', full: '/images/activities/0014 - ptm - 2024-12-16.jpeg', alt: 'Tatap Muka', caption: 'Pembelajaran Tatap Muka 2024/2025', pinned: false },
                        { thumb: '/images/activities/0036 - raport - 2025-05-10.jpeg', full: '/images/activities/0036 - raport - 2025-05-10.jpeg', alt: 'Raport', caption: 'Pembagian Raport 2024/2025', pinned: false },
                    ]
                @endif,
                openLightbox(index) { this.currentImage = index; this.lightboxOpen = true; },
                closeLightbox()     { this.lightboxOpen = false; }
            };
        }

        const revealEls = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); } });
        }, { threshold: 0.1 });
        revealEls.forEach(el => observer.observe(el));
    </script>
</body>
</html>