<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bina Abdi Wiyata</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap');
        @keyframes pulse-cta {
            0%, 100% {
                transform: scale(1);
                background-color: #2563eb;
                box-shadow: 0 4px 6px rgba(37, 99, 235, 0.5);
            }
            50% {
                transform: scale(1.05);
                background-color: #1d4ed8;
                box-shadow: 0 6px 12px rgba(29, 78, 216, 0.7);
            }
        }
        .animate-cta {
            animation: pulse-cta 2s infinite ease-in-out;
            transition: background-color 0.3s ease;
        }

        .mask-blur {
            mask-image: radial-gradient(ellipse at center, rgba(0,0,0,1) 60%, rgba(0,0,0,0) 100%);
            -webkit-mask-image: radial-gradient(ellipse at center, rgba(0,0,0,1) 60%, rgba(0,0,0,0) 100%);
        }

        /* Splash */
        @keyframes splashFadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes splashLogoIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        @keyframes splashLineGrow {
            from { width: 0; opacity: 0; }
            to   { width: 3rem; opacity: 1; }
        }
        @keyframes splashDotPulse {
            0%, 100% { opacity: 0.3; transform: scale(0.8); }
            50%       { opacity: 1;   transform: scale(1.2); }
        }

        .splash-logo {
            animation: splashLogoIn 1.2s ease forwards;
        }
        .splash-text {
            animation: splashFadeIn 0.7s ease forwards;
            animation-delay: 0.6s;
            opacity: 0;
        }
        .splash-sub {
            animation: splashFadeIn 0.7s ease forwards;
            animation-delay: 0.85s;
            opacity: 0;
        }
        .splash-line {
            animation: splashLineGrow 0.6s ease forwards;
            animation-delay: 1s;
        }
        .splash-dot {
            animation: splashDotPulse 1s ease-in-out infinite;
        }
        .splash-dot:nth-child(2) { animation-delay: 0.2s; }
        .splash-dot:nth-child(3) { animation-delay: 0.4s; }

        .splash-fadeout {
            transition: opacity 0.8s ease, transform 0.8s ease;
            opacity: 0;
            transform: scale(1.03);
        }
    </style>

</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Splash Screen -->
    <div id="splash-screen" class="fixed inset-0 z-50 flex flex-col justify-center items-center bg-gradient-to-b from-white via-blue-50 to-blue-100">

        <!-- Soft background ring -->
        <div class="absolute w-[340px] h-[340px] rounded-full bg-blue-100 opacity-60 blur-3xl pointer-events-none"></div>

        <!-- Logo -->
        <img src="{{ asset('images/baw-logo.webp') }}"
            alt="Logo"
            class="splash-logo relative w-[225px] mb-6 drop-shadow-md" />

        <!-- Divider line -->
        <div class="splash-line h-[2px] bg-blue-300 rounded-full mb-5"></div>

        <!-- Name -->
        <h1 class="splash-text relative text-2xl md:text-4xl font-bold text-blue-900 tracking-wide text-center px-6"
            style="font-family: 'DM Sans', sans-serif;">
            PKBM Homeschooling Bina Abdi Wiyata
        </h1>

        <!-- Tagline -->
        <p class="splash-sub relative text-sm text-blue-400 tracking-widest uppercase mt-2 text-center px-6"
        style="font-family: 'DM Sans', sans-serif;">
            A Life-improving Centre for Community Learning
        </p>

        <!-- Loading dots -->
        <div class="splash-sub relative flex gap-2 mt-10">
            <span class="splash-dot w-2 h-2 rounded-full bg-blue-400 block"></span>
            <span class="splash-dot w-2 h-2 rounded-full bg-blue-400 block"></span>
            <span class="splash-dot w-2 h-2 rounded-full bg-blue-400 block"></span>
        </div>
    </div>

    <div id="main-nav" style="visibility: hidden;">
        @include('/modular-components/multipage/navbar')
    </div>
    @include('/modular-components/homepage/home-content')
    @include('/modular-components/multipage/footer')
</body>
</html>

<!-- Alpine.js -->
<script>
    window.addEventListener('load', () => {
        const splash = document.getElementById('splash-screen');
        const nav = document.getElementById('main-nav');

        setTimeout(() => {
            splash.classList.add('splash-fadeout');
            nav.style.visibility = 'visible'; // reveal nav as splash fades
            setTimeout(() => {
                splash.style.display = 'none';
            }, 850);
        }, 3000);
    });
</script>
