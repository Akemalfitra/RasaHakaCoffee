<script setup lang="ts">
import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { onMounted, onUnmounted, ref } from "vue";

// Definisikan observer di luar hook agar bisa diakses oleh onUnmounted
let observer: IntersectionObserver | null = null;

// Menggunakan onMounted untuk menginisialisasi Intersection Observer saat komponen siap
onMounted(() => {
  const elements = document.querySelectorAll(".animate-on-scroll");

  // Pastikan ada elemen yang akan diobservasi sebelum membuat instancex
  if (elements.length > 0) {
    observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("animate-slide-in");
            // Stop observing elemen setelah animasi berjalan untuk efisiensi
            observer?.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.2, rootMargin: "0px 0px -50px 0px" } // Trigger sedikit lebih awal
    );

    elements.forEach((el) => observer?.observe(el));
  }
});

// Menggunakan onUnmounted untuk membersihkan observer saat komponen dihancurkan
// Ini penting untuk mencegah memory leak
onUnmounted(() => {
  if (observer) {
    observer.disconnect();
  }
});
</script>

<template>
  <Head title="RasaHaka - Kopi Premium dari Takengon" />

  <AuthenticatedLayout>
    <template #header>
      <header class="container mx-auto px-4 py-6 flex flex-col items-center sm:items-start">
        <a
          href="/"
          class="text-3xl sm:text-4xl font-serif font-bold text-amber-800 tracking-tight hover:text-amber-900 transition-colors duration-300"
          aria-label="RasaHaka Coffee Home"
        >
          RasaHaka Coffee
        </a>
        <p class="mt-2 text-base text-stone-700">Takengon, Aceh Tengah, Aceh, Indonesia</p>
      </header>
    </template>

    <main>
      <section
        class="relative w-full h-[60vh] sm:h-[80vh] overflow-hidden bg-stone-900 flex items-center justify-center"
        aria-label="Hero section with video background"
      >
        <div class="absolute inset-0 bg-gradient-to-b from-stone-900/50 to-stone-900/80 z-10"></div>
        <video
          autoplay
          loop
          muted
          playsinline
          class="absolute inset-0 w-full h-full object-cover opacity-70"
          aria-hidden="true"
      >
          <source src="/img/rasahaka-vid.mp4" type="video/mp4" />
          Browser Anda tidak mendukung tag video.
        </video>
        <div class="relative z-20 text-center px-4 sm:px-6">
          <h1
            class="text-4xl sm:text-6xl md:text-7xl font-serif font-extrabold text-cream-50 drop-shadow-xl mb-4 animate-fade-in"
          >
            RasaHaka
          </h1>
          <p
            class="text-lg sm:text-2xl md:text-3xl font-sans font-semibold text-amber-100 drop-shadow-lg mb-8"
          >
            Nikmati Kopi dengan Cita Rasa Unik dari Tanah Aceh
          </p>
          <a
            href="#pelajari-lebih-lanjut"
            class="inline-block px-8 py-4 bg-amber-600 text-cream-50 font-bold rounded-lg shadow-lg hover:bg-amber-700 hover:scale-105 transition-all duration-300 animate-pulse-slow text-lg"
            aria-label="Jelajahi produk kopi kami"
          >
            Jelajahi Kopi Kami
          </a>
        </div>
      </section>

      <section class="py-16 sm:py-20 px-4 sm:px-6 bg-cream-50">
        <div class="container mx-auto text-center animate-on-scroll">
          <h2 class="text-3xl sm:text-4xl font-serif font-bold text-stone-800 mb-6">
            Selamat Datang di RasaHaka
          </h2>
          <p class="text-lg sm:text-xl text-stone-700 leading-relaxed max-w-4xl mx-auto">
            Berdiri sejak 2023, RasaHaka adalah merek kopi premium yang berpusat di Takengon, Aceh
            Tengah. Kami menghadirkan kopi berkualitas tinggi dari perkebunan terbaik
            di dataran tinggi Gayo, dengan komitmen untuk menyajikan cita rasa yang memikat
            bagi para pecinta kopi.
          </p>
        </div>
      </section>

      <section class="py-16 sm:py-20 px-4 sm:px-6 bg-stone-100">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-12 animate-on-scroll">
          <div class="flex flex-col justify-center order-2 md:order-1">
            <h3 class="text-2xl sm:text-3xl font-serif font-bold text-stone-800 mb-4">
              Kafe RasaHaka
            </h3>
            <p class="text-lg sm:text-xl text-stone-700 leading-relaxed">
              Kafe kami adalah tempat di mana Anda dapat menikmati kopi premium dalam suasana
              yang hangat dan autentik di jantung Takengon. Rasakan kekayaan budaya Aceh
              dalam dekorasi yang menggabungkan elemen tradisional dan modern.
            </p>
          </div>
          <div class="order-1 md:order-2">
            <img
              src="/img/rasahaka-cafe.jpg"
              alt="Interior Kafe RasaHaka di Takengon"
              class="w-full h-auto max-h-96 object-cover rounded-xl shadow-xl hover:scale-105 transition-transform duration-500"
            />
          </div>
        </div>
      </section>

      <section class="py-16 sm:py-20 px-4 sm:px-6 bg-stone-100">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-12 animate-on-scroll">
          <div class="order-1 md:order-2">
            <img
              src="/img/takengon-farm.jpg"
              alt="Perkebunan kopi di Takengon"
              class="w-full h-auto max-h-96 object-cover rounded-xl shadow-xl hover:scale-105 transition-transform duration-500"
            />
          </div>
          <div class="flex flex-col justify-center order-2 md:order-1">
            <h3 class="text-2xl sm:text-3xl font-serif font-bold text-stone-800 mb-4">Kisah Kami</h3>
            <p class="text-lg sm:text-xl text-stone-700 leading-relaxed">
              RasaHaka lahir dari kecintaan terhadap kopi Aceh. Berbasis di Takengon, kami bekerja sama dengan petani lokal untuk menghasilkan kopi kualitas terbaik, sekaligus mendukung kesejahteraan komunitas sekitar.
            </p>
          </div>
        </div>
      </section>

      <section class="py-16 sm:py-20 px-4 sm:px-6 bg-cream-50">
        <div class="container mx-auto animate-on-scroll">
          <h2 class="text-3xl sm:text-4xl font-serif font-bold text-stone-800 text-center mb-12">
            Produk Terlaris Kami
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <article
              class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl hover:scale-[1.03] transition-all duration-300 flex flex-col items-center text-center"
            >
              <img
                src="/img/spanish-choco.jpg"
                alt="Produk kopi Spanish Choco"
                class="w-48 h-48 sm:w-56 sm:h-56 object-cover rounded-full mx-auto mb-6 border-4 border-amber-200 hover:scale-110 transition-transform duration-500 shadow-md"
              />
              <h3 class="text-xl sm:text-2xl font-serif font-bold text-stone-800 mb-3">
                Spanish Choco
              </h3>
              <p class="text-base sm:text-lg text-stone-600 mb-6 max-w-sm">
                Perpaduan sempurna antara kopi robusta pilihan dan sentuhan cokelat Spanyol
                yang kaya, menghadirkan rasa manis lembut dengan aroma menggoda.
              </p>
              <a
                href="/produk/spanish-choco"
                class="block mt-auto px-6 py-3 bg-amber-600 text-cream-50 font-semibold rounded-lg hover:bg-amber-700 hover:scale-105 transition-all duration-300 w-fit"
                aria-label="Pesan kopi Spanish Choco"
              >
                Pesan Sekarang
              </a>
            </article>
            <article
              class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl hover:scale-[1.03] transition-all duration-300 flex flex-col items-center text-center"
            >
              <img
                src="/img/spanish-berry.jpg"
                alt="Produk kopi Spanish Berry"
                class="w-48 h-48 sm:w-56 sm:h-56 object-cover rounded-full mx-auto mb-6 border-4 border-amber-200 hover:scale-110 transition-transform duration-500 shadow-md"
              />
              <h3 class="text-xl sm:text-2xl font-serif font-bold text-stone-800 mb-3">
                Spanish Berry
              </h3>
              <p class="text-base sm:text-lg text-stone-600 mb-6 max-w-sm">
                Rasakan kesegaran kopi arabika yang dipadukan dengan nuansa buah beri Spanyol,
                menawarkan cita rasa asam manis yang menyegarkan dan unik.
              </p>
              <a
                href="/produk/spanish-berry"
                class="block mt-auto px-6 py-3 bg-amber-600 text-cream-50 font-semibold rounded-lg hover:bg-amber-700 hover:scale-105 transition-all duration-300 w-fit"
                aria-label="Pesan kopi Spanish Berry"
              >
                Pesan Sekarang
              </a>
            </article>
          </div>
        </div>
      </section>

      <section
        id="pelajari-lebih-lanjut"
        class="py-16 sm:py-20 px-4 sm:px-6 bg-cream-50 text-stone-800"
      >
        <div class="container mx-auto text-center animate-on-scroll">
          <h2 class="text-3xl sm:text-4xl font-serif font-bold mb-6">Rasakan Keunikan RasaHaka</h2>
          <p class="text-lg sm:text-xl leading-relaxed max-w-2xl mx-auto mb-8">
            Jadilah bagian dari perjalanan cita rasa kami. Jelajahi koleksi kopi RasaHaka dan temukan
            favorit Anda hari ini!
          </p>
          <a
            href="/user-menu"
            class="inline-block px-8 py-4 bg-amber-600 text-cream-50 font-bold rounded-lg shadow-lg hover:bg-amber-700 hover:scale-105 transition-all duration-300 animate-pulse-slow text-lg"
            aria-label="Belanja produk kopi RasaHaka"
          >
            Belanja Sekarang
          </a>
        </div>
      </section>

      <footer class="py-6 px-4 sm:px-6 bg-cream-50 text-stone-700">
        <div class="container mx-auto text-center animate-on-scroll">
          <h3 class="text-sm font-serif font-semibold text-stone-700 mb-4">
            Sponsored By
          </h3>
          <div class="flex justify-center items-center gap-8">
            <a
              href="https://www.instagram.com/rasahaka.id/"
              class="block transform hover:scale-110 hover:opacity-90 transition-all duration-300"
              aria-label="Kunjungi Instagram RasaHaka"
            >
              <img
                src="/img/logo.png"
                alt="Logo RasaHaka.id"
                class="w-12 h-auto object-contain"
              />
            </a>
            <a
              href="https://www.instagram.com/kopite_id/"
              class="block transform hover:scale-110 hover:opacity-90 transition-all duration-300"
              aria-label="Kunjungi Instagram Kopite.id"
            >
              <img
                src="/img/kopite-logo.png"
                alt="Logo Kopite.id"
                class="w-12 h-auto object-contain"
              />
            </a>
          </div>
          <div class="mt-6 border-t border-stone-300 pt-4">
            <p class="text-sm text-stone-600 mb-2">© 2025 RasaHaka Coffee. All rights reserved.</p>
          </div>
        </div>
      </footer>
    </main>
  </AuthenticatedLayout>
</template>

<style>
html {
  scroll-behavior: smooth;
}
</style>

<style scoped>
/* Custom animations */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(40px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes pulseSlow {
  0%,
  100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.03);
  }
}

.animate-fade-in {
  animation: fadeIn 1s ease-out forwards;
}

/* Kelas ini awalnya punya 'opacity: 0' yang akan membuat elemen tidak terlihat sebelum di-scroll */
.animate-slide-in {
  animation: slideIn 0.8s ease-out forwards;
}

.animate-pulse-slow {
  animation: pulseSlow 2.5s infinite ease-in-out;
}

/* Coffee-themed background texture */
.bg-cream-50 {
  background-color: #fefbf8; /* Fallback color */
  background-image: linear-gradient(to bottom, #fefbf8, #f7ede2);
}

.bg-stone-100 {
  background-color: #f5f5f4; /* Fallback color */
  background-image: linear-gradient(to bottom, #f5f5f4, #e8e6e4);
}

/* Custom color for better contrast */
.text-cream-50 {
  color: #fffaf0;
}

/* Optimize for accessibility and performance */
:focus-visible {
  outline: 3px solid #f59e0b;
  outline-offset: 2px;
}

/* Reduced motion for accessibility */
@media (prefers-reduced-motion: reduce) {
  .animate-fade-in,
  .animate-slide-in,
  .animate-pulse-slow,
  .hover\:scale-105,
  .hover\:scale-110 {
    animation: none !important;
    transform: none !important;
    transition: none !important;
  }
}
</style>