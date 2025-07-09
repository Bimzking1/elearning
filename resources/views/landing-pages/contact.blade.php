<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contact | E-Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    @include('/modular-components/multipage/navbar')

    <main class="bg-gradient-to-b from-white to-blue-200 py-8 md:py-16">
        <div class="w-full mx-auto px-6 lg:px-8 space-y-16">

            <!-- Section: Contact Info + Image -->
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <!-- Left: Contact Info -->
                <div class="space-y-10">
                    <!-- Heading -->
                    <div>
                        <h1 class="text-4xl font-extrabold text-blue-900 mb-2">Contact Us</h1>
                        <p class="text-lg text-gray-600">We are ready to assist you with the best information and services.</p>
                    </div>

                    <!-- Address Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">PKBM Bina Abdi Wiyata</h2>
                        <p class="text-gray-900 leading-relaxed">
                            Jl. Jolotundo Baru No.6, Pacar Keling,<br />
                            Tambaksari District, Surabaya, East Java 60131
                        </p>
                        <p class="text-gray-800 font-medium mt-4">
                            Phone: <span class="text-blue-900">0877-0199-0961</span>
                        </p>
                        <p class="text-gray-800 font-medium">
                            WhatsApp:
                            <a href="https://wa.me/6287701990961" target="_blank" rel="noopener noreferrer" class="text-blue-900 hover:underline">
                                087701990961
                            </a>
                        </p>
                    </div>

                    <!-- Email Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Email</h2>
                        <p class="text-gray-900">Send your questions or inquiries to our official email address:</p>
                        <a href="mailto:pkbmbaw2019@gmail.com" class="block mt-3 text-2xl text-blue-600 font-semibold hover:underline">
                            pkbmbaw2019@gmail.com
                        </a>
                    </div>
                </div>

                <!-- Right: Contact Image -->
                <div class="flex justify-center">
                    <img src="{{ asset('images/contact.png') }}"
                         alt="Contact Illustration"
                         class="rounded-lg w-full md:w-[600px] object-cover md:mt-20" />
                </div>
            </div>
        </div>
    </main>

    <!-- Section: Google Map -->
    <section class="bg-gradient-to-b from-blue-200 to-white md:py-16 pb-8">
        <div class="w-full mx-auto px-6 lg:px-8 space-y-10">
            <div>
                <h2 class="text-4xl font-extrabold text-blue-900 mb-2">Visit Our Location</h2>
                <p class="text-lg text-gray-600">We warmly welcome you and are ready to provide the best information and services.</p>
            </div>

            <!-- Google Maps Embed -->
            <div class="w-full h-[400px] rounded-lg overflow-hidden shadow-md">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d343.1417804693158!2d112.76214976381176!3d-7.258276136335872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f9787d41ca23%3A0xa6795d6b7c5a7420!2sPKBM%20Bina%20Abdi%20Wiyata%20%26%20Semar%20Coffee!5e1!3m2!1sen!2sid!4v1751291866821!5m2!1sen!2sid"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
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
