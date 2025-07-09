<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Our Programs | E-Learning Platform</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  @include('/modular-components/multipage/navbar')

  <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8 md:py-16">
    <section x-data="programPreview()" @keydown.escape.window="closeLightbox()">
      <h1 class="text-4xl font-extrabold text-blue-900 mb-6 text-center">Our Programs</h1>
      <p class="text-lg text-gray-600 mb-12 max-w-3xl mx-auto text-center">
        PKBM Bina Abdi Wiyata offers alternative education pathways through the Kejar Paket programs and Homeschooling — ensuring everyone has the opportunity to complete their education at their own pace.
      </p>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <template x-for="(program, index) in programs" :key="index">
          <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition-all duration-300">
            <button @click="openLightbox(index)" class="group relative w-full aspect-video overflow-hidden rounded-lg mb-4 shadow focus:outline-none">
              <img :src="program.thumb" :alt="program.caption" class="w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-105" loading="lazy" />
              <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent text-white text-sm p-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <span x-text="program.caption"></span>
              </div>
            </button>
            <h2 class="text-2xl font-semibold text-blue-600 mb-2" x-text="program.caption"></h2>
            <p x-text="descriptions[index]"></p>
          </div>
        </template>
      </div>

      <!-- Lightbox Modal -->
      <div x-show="lightboxOpen" style="display: none;" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50" @click.self="closeLightbox()">
        <button @click="closeLightbox()" class="absolute top-5 right-5 text-white text-3xl font-bold focus:outline-none" aria-label="Close lightbox">&times;</button>
        <div class="max-w-4xl max-h-[90vh] px-4">
          <img :src="programs[currentImage].full" :alt="programs[currentImage].caption" class="rounded-lg max-w-full max-h-full mx-auto" />
          <p class="text-white mt-4 text-center text-lg" x-text="programs[currentImage].caption"></p>
        </div>
      </div>
    </section>
  </main>

  @include('/modular-components/multipage/footer')

  <script>
    function programPreview() {
      return {
        lightboxOpen: false,
        currentImage: 0,
        programs: [
          {
            thumb: '/images/activities/0037 - anbk-a - 2024-10-14.jpeg',
            full: '/images/activities/0037 - anbk-a - 2024-10-14.jpeg',
            caption: 'Kejar Paket A (Setara SD)'
          },
          {
            thumb: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg',
            full: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg',
            caption: 'Kejar Paket B (Setara SMP)'
          },
          {
            thumb: '/images/activities/0015 - ptm - 2024-12-16.jpeg',
            full: '/images/activities/0015 - ptm - 2024-12-16.jpeg',
            caption: 'Kejar Paket C (Setara SMA)'
          },
          {
            thumb: '/images/activities/homeschool.jpg',
            full: '/images/activities/homeschool.jpg',
            caption: 'Homeschooling'
          }
        ],
        descriptions: [
        'A basic education program for school-age children and adults who have not completed elementary school. The curriculum follows national standards with an emphasis on literacy, numeracy, character building, and basic life skills.',
        'A lower secondary education program for graduates of Paket A or elementary school. The material focuses on developing foundational knowledge, logic, and practical skills for daily life and preparation for high school.',
        'An upper secondary education program for learners who have completed Paket B or junior high school. Designed to prepare students for the workforce or higher education, with a national curriculum and flexible learning schedule.',
        'A flexible learning system conducted from home with professional tutor support. Suitable for students with special needs, busy schedules, or those seeking a more personalized learning approach that suits their own pace.'
        ],
        openLightbox(index) {
          this.currentImage = index;
          this.lightboxOpen = true;
        },
        closeLightbox() {
          this.lightboxOpen = false;
        }
      };
    }
  </script>

</body>
</html>
