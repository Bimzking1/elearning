<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registration | E-Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    @include('/modular-components/multipage/navbar')

    <main class="bg-gradient-to-b from-white to-blue-200 py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-16">
            <div class="grid md:grid-cols-2 gap-10 items-center">

                <!-- Left: Info and CTA -->
                <div class="space-y-10">
                    <div>
                        <h1 class="text-4xl font-extrabold text-blue-900 mb-4">New Student Registration</h1>
                        <p class="text-lg text-gray-700">
                            Register now to join us at PKBM Bina Abdi Wiyata.
                            Flexible, quality education with official certification awaits you.
                        </p>
                    </div>

                    <div>
                        <a href="https://intip.in/PendaftaranPKBMBAWSBY" target="_blank"
                           class="inline-block px-6 py-3 bg-blue-700 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-800 transition duration-200">
                            Register Now
                        </a>
                    </div>
                </div>

                <!-- Right: Image -->
                <div class="flex justify-center">
                    <img src="{{ asset('images/register.png') }}"
                         alt="Register Illustration"
                         class="rounded-lg w-full md:w-[600px] object-cover smd:mt-10" />
                </div>

            </div>
        </div>
    </main>

    @include('/modular-components/multipage/footer')

</body>
</html>
