<template>
  <section 
    id="inicio"
    class="relative mt-[72px] flex min-h-screen items-center overflow-hidden"
  >
    <!-- Video de fondo o carrusel de imágenes -->
    <div class="absolute inset-0 z-0">
      <div
        class="flex h-full w-full transition-all duration-1000 ease-in-out"
        :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
      >
        <div
          v-for="(img, index) in heroImages"
          :key="index"
          class="relative min-w-full h-full flex-shrink-0"
        >
          <img
            :src="img"
            alt="Hotel"
            class="h-full w-full object-cover"
          />
          <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/30"></div>
        </div>
      </div>
    </div>

    <!-- Contenido principal -->
    <div class="relative z-10 mx-auto w-full max-w-[1400px] px-6 py-20 md:py-32">
      <div class="max-w-3xl">
        <!-- Badge -->
        <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-amber-500/20 backdrop-blur-sm px-4 py-2 text-amber-300 border border-amber-400/30">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
          </svg>
          <span class="text-sm font-semibold">Hotel 5 Estrellas</span>
        </div>

        <!-- Título principal -->
        <h1 class="mb-6 text-5xl md:text-7xl font-bold leading-tight">
          <span class="text-white drop-shadow-lg">
            Bienvenido a
          </span>
          <br />
          <span class="bg-gradient-to-r from-amber-300 via-amber-400 to-yellow-300 bg-clip-text text-transparent drop-shadow-xl">
            Hotel Nuevo
          </span>
        </h1>

        <!-- Descripción -->
        <p class="mb-8 text-lg md:text-xl text-gray-200 leading-relaxed max-w-2xl drop-shadow-md">
          Experimenta el lujo y la comodidad en el corazón de la ciudad. 
          Habitaciones elegantes, servicios excepcionales y una experiencia inolvidable te esperan.
        </p>

        <!-- Características rápidas -->
        <div class="mb-10 flex flex-wrap gap-4 text-white">
          <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 border border-white/20">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-amber-400">
              <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
            </svg>
            <span class="text-sm font-medium">Ubicación céntrica</span>
          </div>
          <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 border border-white/20">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-amber-400">
              <path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 00-1.905 3.959c-.023.222-.014.442.025.654a4.97 4.97 0 01-2.07-.655zM16.44 15.98a4.97 4.97 0 002.07-.654.78.78 0 00.357-.442 3 3 0 00-4.308-3.517 6.484 6.484 0 011.907 3.96 2.32 2.32 0 01-.026.654zM18 8a2 2 0 11-4 0 2 2 0 014 0zM5.304 16.19a.844.844 0 01-.277-.71 5 5 0 019.947 0 .843.843 0 01-.277.71A6.975 6.975 0 0110 18a6.974 6.974 0 01-4.696-1.81z" />
            </svg>
            <span class="text-sm font-medium">Servicio 24/7</span>
          </div>
          <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 border border-white/20">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-amber-400">
              <path d="M10.75 10.818v2.614A3.13 3.13 0 0011.888 13c.482-.315.612-.648.612-.875 0-.227-.13-.56-.612-.875a3.13 3.13 0 00-1.138-.432zM8.33 8.62c.053.055.115.11.184.164.208.16.46.284.736.363V6.603a2.45 2.45 0 00-.35.13c-.14.065-.27.143-.386.233-.377.292-.514.627-.514.909 0 .184.058.39.202.592.037.051.08.102.128.152z" />
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-6a.75.75 0 01.75.75v.316a3.78 3.78 0 011.653.713c.426.33.744.74.925 1.2a.75.75 0 01-1.395.55 1.35 1.35 0 00-.447-.563 2.187 2.187 0 00-.736-.363V9.3c.698.093 1.383.32 1.959.696.787.514 1.29 1.27 1.29 2.13 0 .86-.504 1.616-1.29 2.13-.576.377-1.261.603-1.96.696v.299a.75.75 0 11-1.5 0v-.3c-.697-.092-1.382-.318-1.958-.695-.482-.315-.857-.717-1.078-1.188a.75.75 0 111.359-.636c.08.173.245.376.54.569.313.205.706.353 1.138.432v-2.748a3.782 3.782 0 01-1.653-.713C6.9 9.433 6.5 8.681 6.5 7.875c0-.805.4-1.558 1.097-2.096a3.78 3.78 0 011.653-.713V4.75A.75.75 0 0110 4z" clip-rule="evenodd" />
            </svg>
            <span class="text-sm font-medium">Mejor precio garantizado</span>
          </div>
        </div>

        <!-- Botones de acción -->
        <div class="flex flex-wrap gap-4">
          <a 
            href="#contacto" 
            class="group flex items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 
                   hover:from-amber-600 hover:to-amber-700 text-white px-8 py-4 rounded-full 
                   shadow-xl hover:shadow-2xl transition-all duration-300 font-semibold text-lg
                   transform hover:scale-105"
          >
            <span>Reservar Ahora</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition-transform">
              <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
            </svg>
          </a>
          <a 
            href="#habitaciones"
            class="flex items-center gap-2 bg-white/10 backdrop-blur-sm hover:bg-white/20 
                   text-white px-8 py-4 rounded-full border-2 border-white/30 hover:border-white/50
                   transition-all duration-300 font-semibold text-lg transform hover:scale-105"
          >
            <span>Ver Habitaciones</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
          </a>
        </div>
      </div>
    </div>

    <!-- Indicadores de carrusel -->
    <div class="absolute bottom-8 left-1/2 z-20 flex -translate-x-1/2 gap-2">
      <button
        v-for="(_, index) in heroImages"
        :key="index"
        @click="currentIndex = index"
        :class="[
          'h-2 rounded-full transition-all duration-300',
          currentIndex === index 
            ? 'w-8 bg-amber-500' 
            : 'w-2 bg-white/50 hover:bg-white/80'
        ]"
      ></button>
    </div>

    <!-- Botones de navegación -->
    <button 
      @click="prev" 
      class="absolute left-4 top-1/2 z-20 -translate-y-1/2 hidden md:flex
             bg-white/10 backdrop-blur-sm hover:bg-white/20 
             p-4 rounded-full shadow-lg border border-white/30
             transition-all duration-300 group"
    >
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-white group-hover:-translate-x-1 transition-transform">
        <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
      </svg>
    </button>
    <button 
      @click="next" 
      class="absolute right-4 top-1/2 z-20 -translate-y-1/2 hidden md:flex
             bg-white/10 backdrop-blur-sm hover:bg-white/20 
             p-4 rounded-full shadow-lg border border-white/30
             transition-all duration-300 group"
    >
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-white group-hover:translate-x-1 transition-transform">
        <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
      </svg>
    </button>

    <!-- Scroll indicator -->
    <div class="absolute bottom-24 left-1/2 z-20 -translate-x-1/2 animate-bounce hidden md:block">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-8 h-8 text-white">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
      </svg>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from "vue";

const heroImages = [
  "/imagenes/hotel-hero-1.jpg",
  "/imagenes/hotel-hero-2.jpg",
  "/imagenes/hotel-hero-3.jpg",
  "/imagenes/hotel-hero-4.jpg",
  "/imagenes/hotel-hero-5.jpg",
];

const currentIndex = ref(0);

const prev = (): void => {
  currentIndex.value = (currentIndex.value - 1 + heroImages.length) % heroImages.length;
};

const next = (): void => {
  currentIndex.value = (currentIndex.value + 1) % heroImages.length;
};

let intervalId: number;
onMounted(() => {
  intervalId = window.setInterval(next, 6000);
});

onUnmounted(() => {
  clearInterval(intervalId);
});
</script>