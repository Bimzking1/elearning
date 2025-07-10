<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Activities - Bina Abdi Wiyata</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  @include('/modular-components/multipage/navbar')

  <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8 md:py-16">
    <section>
      <h1 class="text-4xl font-extrabold text-blue-900 mb-6">School Activities</h1>
      <p class="text-lg text-gray-600 mb-12 max-w-3xl">
        Explore the vibrant activities at PKBM Bina Abdi Wiyata, showcasing our students’ achievements, events, and community involvement.
      </p>

      <!-- Gallery Grid -->
      <div
        class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4"
        x-data="gallery()"
        @keydown.escape.window="closeLightbox()"
      >
        <!-- Gallery Images Loop -->
        <template x-for="(img, index) in images" :key="index">
          <div>
            <button
              class="group relative w-full aspect-[4/3] overflow-hidden rounded-lg shadow-md focus:outline-none"
              @click="openLightbox(index)"
              type="button"
              :aria-label="'Open image ' + (index + 1)"
            >
              <img
                :src="img.thumb"
                :alt="img.alt"
                loading="lazy"
                class="w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-105"
              />
              <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent text-white text-sm p-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <span x-text="img.caption"></span>
              </div>
            </button>
          </div>
        </template>

        <!-- Lightbox Modal -->
        <div
          x-show="lightboxOpen"
          style="display: none;"
          class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50"
          @click.self="closeLightbox()"
        >
          <button
            @click="closeLightbox()"
            class="absolute top-5 right-5 text-white text-3xl font-bold focus:outline-none"
            aria-label="Close lightbox"
          >&times;</button>

          <div class="max-w-4xl max-h-[90vh]">
            <img
              :src="images[currentImage].full"
              :alt="images[currentImage].alt"
              class="rounded-lg max-w-full max-h-full mx-auto"
            />
            <p class="text-white mt-4 text-center" x-text="images[currentImage].caption"></p>
          </div>
        </div>
      </div>
    </section>
  </main>

  @include('/modular-components/multipage/footer')

  <script>
    function gallery() {
      return {
        lightboxOpen: false,
        currentImage: 0,
        images: [
          // Example images, replace with actual paths and alt/caption
          { thumb: '/images/activities/0001 - mpls - 2024-07-15.jpeg', full: '/images/activities/0001 - mpls - 2024-07-15.jpeg', alt: 'Activity 1', caption: 'MPLS 2024/2025' },
          { thumb: '/images/activities/0002 - mpls - 2024-07-15.jpeg', full: '/images/activities/0002 - mpls - 2024-07-15.jpeg', alt: 'Activity 1', caption: 'MPLS 2024/2025' },
          { thumb: '/images/activities/0003 - mpls - 2024-07-15.jpeg', full: '/images/activities/0003 - mpls - 2024-07-15.jpeg', alt: 'Activity 1', caption: 'MPLS 2024/2025' },
          { thumb: '/images/activities/0004 - mpls - 2024-07-15.jpeg', full: '/images/activities/0004 - mpls - 2024-07-15.jpeg', alt: 'Activity 1', caption: 'MPLS 2024/2025' },
          { thumb: '/images/activities/0005 - mpls - 2024-07-15.jpeg', full: '/images/activities/0005 - mpls - 2024-07-15.jpeg', alt: 'Activity 1', caption: 'MPLS 2024/2025' },
          { thumb: '/images/activities/0006 - mpls - 2024-07-15.jpeg', full: '/images/activities/0006 - mpls - 2024-07-15.jpeg', alt: 'Activity 1', caption: 'MPLS 2024/2025' },
          { thumb: '/images/activities/0007 - mpls - 2024-07-15.jpeg', full: '/images/activities/0007 - mpls - 2024-07-15.jpeg', alt: 'Activity 1', caption: 'MPLS 2024/2025' },
          { thumb: '/images/activities/0008 - mpls - 2024-07-15.jpeg', full: '/images/activities/0008 - mpls - 2024-07-15.jpeg', alt: 'Activity 1', caption: 'MPLS 2024/2025' },
          { thumb: '/images/activities/0009 - mpls - 2024-07-15.jpeg', full: '/images/activities/0009 - mpls - 2024-07-15.jpeg', alt: 'Activity 1', caption: 'MPLS 2024/2025' },
          { thumb: '/images/activities/0010 - hutri - 2024-08-12.jpeg', full: '/images/activities/0010 - hutri - 2024-08-12.jpeg', alt: 'Activity 2', caption: 'HUT RI 2024' },
          { thumb: '/images/activities/0011 - hutri - 2024-08-12.jpeg', full: '/images/activities/0011 - hutri - 2024-08-12.jpeg', alt: 'Activity 2', caption: 'HUT RI 2024' },
          { thumb: '/images/activities/0012 - hutri - 2024-08-12.jpeg', full: '/images/activities/0012 - hutri - 2024-08-12.jpeg', alt: 'Activity 2', caption: 'HUT RI 2024' },
          { thumb: '/images/activities/0013 - hutri - 2024-08-12.jpeg', full: '/images/activities/0013 - hutri - 2024-08-12.jpeg', alt: 'Activity 2', caption: 'HUT RI 2024' },
          { thumb: '/images/activities/0014 - ptm - 2024-12-16.jpeg', full: '/images/activities/0014 - ptm - 2024-12-16.jpeg', alt: 'Activity 3', caption: 'Pembelajaran Tatap Muka 2024/2025' },
          { thumb: '/images/activities/0015 - ptm - 2024-12-16.jpeg', full: '/images/activities/0015 - ptm - 2024-12-16.jpeg', alt: 'Activity 3', caption: 'Pembelajaran Tatap Muka 2024/2025' },
          { thumb: '/images/activities/0016 - ptm - 2024-12-16.jpeg', full: '/images/activities/0016 - ptm - 2024-12-16.jpeg', alt: 'Activity 3', caption: 'Pembelajaran Tatap Muka 2024/2025' },
          { thumb: '/images/activities/0037 - anbk-a - 2024-10-14.jpeg', full: '/images/activities/0037 - anbk-a - 2024-10-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket A - 2024/2025' },
          { thumb: '/images/activities/0038 - anbk-a - 2024-10-14.jpeg', full: '/images/activities/0038 - anbk-a - 2024-10-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket A - 2024/2025' },
          { thumb: '/images/activities/0039 - anbk-a - 2024-10-14.jpeg', full: '/images/activities/0039 - anbk-a - 2024-10-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket A - 2024/2025' },
          { thumb: '/images/activities/0040 - anbk-a - 2024-10-14.jpeg', full: '/images/activities/0040 - anbk-a - 2024-10-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket A - 2024/2025' },
          { thumb: '/images/activities/0041 - anbk-a - 2024-10-14.jpeg', full: '/images/activities/0041 - anbk-a - 2024-10-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket A - 2024/2025' },
          { thumb: '/images/activities/0042 - anbk-a - 2024-10-14.jpeg', full: '/images/activities/0042 - anbk-a - 2024-10-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket A - 2024/2025' },
          { thumb: '/images/activities/0043 - anbk-a - 2024-10-14.jpeg', full: '/images/activities/0043 - anbk-a - 2024-10-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket A - 2024/2025' },
          { thumb: '/images/activities/0044 - anbk-a - 2024-10-14.jpeg', full: '/images/activities/0044 - anbk-a - 2024-10-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket A - 2024/2025' },
          { thumb: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg', full: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket B - 2024/2025' },
          { thumb: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg', full: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket B - 2024/2025' },
          { thumb: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg', full: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket B - 2024/2025' },
          { thumb: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg', full: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket B - 2024/2025' },
          { thumb: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg', full: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket B - 2024/2025' },
          { thumb: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg', full: '/images/activities/0045 - anbk-b - 2024-09-05.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket B - 2024/2025' },
          { thumb: '/images/activities/0017 - anbk - 2024-08-14.jpeg', full: '/images/activities/0017 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0018 - anbk - 2024-08-14.jpeg', full: '/images/activities/0018 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0019 - anbk - 2024-08-14.jpeg', full: '/images/activities/0019 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0020 - anbk - 2024-08-14.jpeg', full: '/images/activities/0020 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0021 - anbk - 2024-08-14.jpeg', full: '/images/activities/0021 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0022 - anbk - 2024-08-14.jpeg', full: '/images/activities/0022 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0023 - anbk - 2024-08-14.jpeg', full: '/images/activities/0023 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0024 - anbk - 2024-08-14.jpeg', full: '/images/activities/0024 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0025 - anbk - 2024-08-14.jpeg', full: '/images/activities/0025 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0026 - anbk - 2024-08-14.jpeg', full: '/images/activities/0026 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0027 - anbk - 2024-08-14.jpeg', full: '/images/activities/0027 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0028 - anbk - 2024-08-14.jpeg', full: '/images/activities/0028 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0029 - anbk - 2024-08-14.jpeg', full: '/images/activities/0029 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0030 - anbk - 2024-08-14.jpeg', full: '/images/activities/0030 - anbk - 2024-08-14.jpeg', alt: 'Activity 4', caption: 'Asesmen Nasional Berbasis Komputer Paket C - 2024/2025' },
          { thumb: '/images/activities/0031 - raker - 2025-05-10.jpeg', full: '/images/activities/0031 - raker - 2025-05-10.jpeg', alt: 'Activity 5', caption: 'Rapat Kerja Para Tutor 2024/2025' },
          { thumb: '/images/activities/0032 - raker - 2025-05-10.jpeg', full: '/images/activities/0032 - raker - 2025-05-10.jpeg', alt: 'Activity 5', caption: 'Rapat Kerja Para Tutor 2024/2025' },
          { thumb: '/images/activities/0033 - raker - 2025-05-10.jpeg', full: '/images/activities/0033 - raker - 2025-05-10.jpeg', alt: 'Activity 5', caption: 'Rapat Kerja Para Tutor 2024/2025' },
          { thumb: '/images/activities/0034 - raker - 2025-05-10.jpeg', full: '/images/activities/0034 - raker - 2025-05-10.jpeg', alt: 'Activity 5', caption: 'Rapat Kerja Para Tutor 2024/2025' },
          { thumb: '/images/activities/0035 - raker - 2025-05-10.jpeg', full: '/images/activities/0035 - raker - 2025-05-10.jpeg', alt: 'Activity 5', caption: 'Rapat Kerja Para Tutor 2024/2025' },
          { thumb: '/images/activities/0036 - raport - 2025-05-10.jpeg', full: '/images/activities/0036 - raport - 2025-05-10.jpeg', alt: 'Activity 6', caption: 'Pembagian Raport 2024/2025' },
        ],
        openLightbox(index) {
          this.currentImage = index;
          this.lightboxOpen = true;
        },
        closeLightbox() {
          this.lightboxOpen = false;
        }
      }
    }
  </script>
</body>
</html>
