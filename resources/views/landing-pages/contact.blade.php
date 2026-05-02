<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contact - Bina Abdi Wiyata</title>
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

        .contact-card {
            background: white;
            border: 1px solid var(--blue-pale);
            border-radius: 1rem;
            padding: 1.75rem;
            transition: transform 0.3s cubic-bezier(0.34,1.4,0.64,1), box-shadow 0.3s ease;
        }
        .contact-card:hover {
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
<body class="bg-[var(--gray-subtle)] text-[var(--text-main)]">

    @include('/modular-components/multipage/navbar')

    <!-- Hero -->
    <section class="relative overflow-hidden noise-bg bg-gradient-to-b from-white via-[#eff6ff] to-[#dbeafe] py-14 px-6">
        <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[600px] h-[300px] rounded-full bg-blue-100 opacity-50 blur-3xl pointer-events-none"></div>
        <div class="relative z-10 max-w-3xl mx-auto text-center reveal">
            <h1 class="text-4xl md:text-5xl font-bold text-[var(--blue-deep)] mt-3 mb-3 leading-tight">
                Contact <em class="not-italic text-[var(--blue-mid)]">Us</em>
            </h1>
            <div class="flex justify-center mb-5"><span class="gold-rule"></span></div>
            <p class="text-base md:text-lg text-[var(--text-muted)] max-w-xl mx-auto leading-relaxed">
                We are ready to assist you with the best information and services.
            </p>
        </div>
    </section>

    <!-- Contact Info + Image -->
    <main class="bg-gradient-to-b from-[#dbeafe] to-white">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-2 items-center">

                <!-- Left: Contact Cards -->
                <div class="space-y-5">

                    <!-- Address -->
                    <div class="reveal contact-card" style="transition-delay:0s">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-[var(--blue-pale)] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[var(--blue-mid)]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-[var(--blue-deep)]">PKBM Homeschooling Bina Abdi Wiyata</h2>
                        </div>
                        <p class="text-sm text-[var(--text-muted)] leading-relaxed pl-[3.25rem]">
                            Jl. Jolotundo Baru No.6, Pacar Keling,<br/>
                            Tambaksari District, Surabaya, East Java 60131
                        </p>
                    </div>

                    <!-- WhatsApp -->
                    <div class="reveal contact-card" style="transition-delay:0.08s">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-[var(--blue-pale)] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[var(--blue-mid)]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-[var(--blue-deep)]">WhatsApp or Phone</h2>
                        </div>
                        <div class="pl-[3.25rem]">
                            <a href="https://wa.me/6287701990961" target="_blank" rel="noopener noreferrer"
                               class="text-[var(--blue-mid)] font-semibold hover:text-[var(--blue-deep)] transition-colors duration-200 flex items-center gap-1.5 group text-sm">
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                0877-0199-0961
                            </a>
                            <a href="https://wa.me/6281231166033" target="_blank" rel="noopener noreferrer"
                               class="text-[var(--blue-mid)] font-semibold hover:text-[var(--blue-deep)] transition-colors duration-200 flex items-center gap-1.5 group text-sm">
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                0812 3116 6033
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="reveal contact-card" style="transition-delay:0.16s">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-[var(--blue-pale)] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[var(--blue-mid)]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-[var(--blue-deep)]">Email</h2>
                        </div>
                        <div class="pl-[3.25rem]">
                            <a href="mailto:pkbmbaw2019@gmail.com"
                               class="text-[var(--blue-mid)] font-semibold hover:text-[var(--blue-deep)] transition-colors duration-200 flex items-center gap-1.5 group text-sm">
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                pkbmbaw2019@gmail.com
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right: Image -->
                <div class="flex justify-center reveal" style="transition-delay:0.2s">
                    <img src="{{ asset('images/contact.webp') }}"
                         alt="Contact Illustration"
                         class="rounded-2xl w-full md:w-[480px] object-cover"/>
                </div>
            </div>
        </div>
    </main>

    <!-- Map Section -->
    <section class="bg-gradient-to-b from-white to-[#dbeafe] py-14 md:py-20">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-10 reveal">
                <span class="section-label">Find Us</span>
                <h2 class="text-3xl md:text-4xl font-bold text-[var(--blue-deep)] mt-3 mb-2">
                    Visit Our <em class="not-italic text-[var(--blue-mid)]">Location</em>
                </h2>
                <div class="flex justify-center mb-4"><span class="gold-rule"></span></div>
                <p class="text-base text-[var(--text-muted)]">We warmly welcome you and are ready to provide the best information and services.</p>
            </div>

            <div class="reveal w-full h-[420px] rounded-2xl overflow-hidden shadow-xl border border-[var(--blue-pale)]" style="transition-delay:0.15s">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d343.1417804693158!2d112.76214976381176!3d-7.258276136335872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f9787d41ca23%3A0xa6795d6b7c5a7420!2sPKBM%20Bina%20Abdi%20Wiyata%20%26%20Semar%20Coffee!5e1!3m2!1sen!2sid!4v1751291866821!5m2!1sen!2sid"
                    width="100%" height="100%"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    @include('/modular-components/multipage/footer')

    <script>
        const revealEls = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); } });
        }, { threshold: 0.1 });
        revealEls.forEach(el => observer.observe(el));
    </script>
</body>
</html>