<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @keyframes pulse-cta {
            0%, 100% {
                transform: scale(1);
                background-color: #2563eb; /* blue-600 */
                box-shadow: 0 4px 6px rgba(37, 99, 235, 0.5);
            }
            50% {
                transform: scale(1.05);
                background-color: #1d4ed8; /* blue-700 */
                box-shadow: 0 6px 12px rgba(29, 78, 216, 0.7);
            }
        }

        .animate-cta {
            animation: pulse-cta 2s infinite ease-in-out;
            transition: background-color 0.3s ease;
        }

        /* New fade-in animation */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .fade-in {
            animation: fadeIn 2s ease forwards;
        }

        /* Custom class to add blur effect at the edges */
        .mask-blur {
        mask-image: radial-gradient(ellipse at center, rgba(0,0,0,1) 60%, rgba(0,0,0,0) 100%);
        -webkit-mask-image: radial-gradient(ellipse at center, rgba(0,0,0,1) 60%, rgba(0,0,0,0) 100%);
        }
    </style>

</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Splash Screen -->
    <div id="splash-screen" class="fixed inset-0 bg-white flex flex-col justify-center items-center z-50">
        <img src="{{ asset('images/baw-logo.png') }}" alt="Logo" class="w-[100px] mb-4 fade-in" />
        <h1 class="text-3xl font-bold text-blue-900">PKBM Bina Abdi Wiyata</h1>
    </div>

    @include('/modular-components/multipage/navbar')
    @include('/modular-components/homepage/home-content')
    @include('/modular-components/multipage/footer')
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
<script>
    window.addEventListener('load', () => {
    const splash = document.getElementById('splash-screen');

    // Keep splash visible for 3 seconds, then fade out
    setTimeout(() => {
        splash.classList.add('opacity-0', 'transition-opacity', 'duration-700');
        // Hide completely after fade out (0.7s)
        setTimeout(() => {
        splash.style.display = 'none';
        }, 700);
    }, 3000); // 3000 ms = 3 seconds
    });
</script>

