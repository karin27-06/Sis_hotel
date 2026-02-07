<template>
  <div class="min-h-screen">
    <Navbar />
    <Inicio />
    <Habitaciones />
    <Services />
    <Galeria />
    <Testimonios />
    <FaqAccordion />
    <Contacto />
    <Footer />
  </div>
</template>

<script setup lang="ts">
import Contacto from '@/components/LandingPage/Contacto.vue';
import FaqAccordion from '@/components/LandingPage/FaqAccordion.vue';
import Footer from '@/components/LandingPage/Footer.vue';
import Galeria from '@/components/LandingPage/Galeria.vue';
import Habitaciones from '@/components/LandingPage/Habitaciones.vue';
import Inicio from '@/components/LandingPage/Inicio.vue';
import Navbar from '@/components/LandingPage/Navbar.vue';
import Services from '@/components/LandingPage/Services.vue';
import Testimonios from '@/components/LandingPage/Testimonios.vue';
</script>

<style>
html {
  scroll-behavior: smooth;
}

/* Estilos globales para el modo oscuro */
.app-dark {
  color-scheme: dark;
}

/* Animaciones adicionales */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fadeInUp {
  animation: fadeInUp 0.6s ease-out;
}

/* Scrollbar personalizado */
::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  @apply bg-gray-100 dark:bg-gray-800;
}

::-webkit-scrollbar-thumb {
  @apply bg-amber-500 hover:bg-amber-600 rounded-full;
}

/* Transiciones suaves para el modo oscuro */
* {
  @apply transition-colors duration-200;
}
</style>