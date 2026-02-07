<template>
  <section 
    id="galeria"
    class="py-20 bg-gradient-to-b from-gray-50 to-white dark:from-gray-800 dark:to-gray-900"
  >
    <div class="mx-auto max-w-[1400px] px-6">
      <!-- Header -->
      <div class="mb-16 text-center">
        <span class="inline-block mb-4 text-amber-600 dark:text-amber-400 font-semibold text-sm tracking-wider uppercase">
          Galería
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
          Descubre Nuestras Instalaciones
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
          Una vista previa de la experiencia que te espera en Hotel Paraíso
        </p>
      </div>

      <!-- Filtros de categorías -->
      <div class="flex flex-wrap justify-center gap-3 mb-12">
        <button
          v-for="categoria in categorias"
          :key="categoria.id"
          @click="categoriaActiva = categoria.id"
          :class="[
            'px-6 py-3 rounded-full font-semibold transition-all duration-300',
            categoriaActiva === categoria.id
              ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg scale-105'
              : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600'
          ]"
        >
          {{ categoria.nombre }}
        </button>
      </div>

      <!-- Grid de imágenes con efecto masonry -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="(imagen, index) in imagenesFiltradas"
          :key="index"
          @click="abrirModal(index)"
          :class="[
            'group relative overflow-hidden rounded-2xl cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500',
            imagen.size === 'large' ? 'md:col-span-2 md:row-span-2' : '',
            imagen.size === 'tall' ? 'row-span-2' : ''
          ]"
        >
          <!-- Imagen -->
          <div class="relative h-full min-h-[300px]">
            <img
              :src="imagen.src"
              :alt="imagen.titulo"
              class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
            />
            
            <!-- Overlay con información -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent 
                        opacity-0 group-hover:opacity-100 transition-opacity duration-300 
                        flex flex-col justify-end p-6">
              <h3 class="text-white text-xl font-bold mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                {{ imagen.titulo }}
              </h3>
              <p class="text-gray-200 text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75">
                {{ imagen.descripcion }}
              </p>
            </div>

            <!-- Icono de expandir -->
            <div class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm 
                        flex items-center justify-center opacity-0 group-hover:opacity-100 
                        transition-opacity duration-300 border border-white/30">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-white">
                <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal de imagen ampliada -->
    <Teleport to="body">
      <div
        v-if="modalAbierto"
        @click="cerrarModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/95 backdrop-blur-sm p-4 animate-fadeIn"
      >
        <button
          @click="cerrarModal"
          class="absolute top-4 right-4 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 
                 flex items-center justify-center transition-colors z-10 border border-white/30"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-white">
            <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
          </svg>
        </button>

        <!-- Navegación -->
        <button
          v-if="indiceModal > 0"
          @click.stop="navegarModal(-1)"
          class="absolute left-4 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 
                 flex items-center justify-center transition-colors border border-white/30"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-white">
            <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
          </svg>
        </button>

        <button
          v-if="indiceModal < imagenesFiltradas.length - 1"
          @click.stop="navegarModal(1)"
          class="absolute right-4 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 
                 flex items-center justify-center transition-colors border border-white/30"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-white">
            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
          </svg>
        </button>

        <!-- Imagen y descripción -->
        <div @click.stop class="max-w-6xl w-full">
          <img
            :src="imagenesFiltradas[indiceModal].src"
            :alt="imagenesFiltradas[indiceModal].titulo"
            class="w-full h-auto max-h-[80vh] object-contain rounded-lg shadow-2xl"
          />
          <div class="mt-6 text-center">
            <h3 class="text-2xl font-bold text-white mb-2">
              {{ imagenesFiltradas[indiceModal].titulo }}
            </h3>
            <p class="text-gray-300">
              {{ imagenesFiltradas[indiceModal].descripcion }}
            </p>
          </div>
        </div>
      </div>
    </Teleport>
  </section>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';

const categoriaActiva = ref('todas');
const modalAbierto = ref(false);
const indiceModal = ref(0);

const categorias = [
  { id: 'todas', nombre: 'Todas' },
  { id: 'habitaciones', nombre: 'Habitaciones' },
  { id: 'instalaciones', nombre: 'Instalaciones' },
  { id: 'restaurante', nombre: 'Restaurante' },
  { id: 'spa', nombre: 'Spa & Wellness' },
];

const galeria = [
  { src: '/imagenes/gallery-1.jpg', titulo: 'Suite Presidencial', descripcion: 'Lujo y confort en cada detalle', categoria: 'habitaciones', size: 'large' },
  { src: '/imagenes/gallery-2.jpg', titulo: 'Lobby Principal', descripcion: 'Elegancia y modernidad', categoria: 'instalaciones', size: 'normal' },
  { src: '/imagenes/gallery-3.jpg', titulo: 'Restaurante Gourmet', descripcion: 'Experiencia culinaria única', categoria: 'restaurante', size: 'normal' },
  { src: '/imagenes/gallery-4.jpg', titulo: 'Piscina Infinity', descripcion: 'Relájate con vistas espectaculares', categoria: 'instalaciones', size: 'tall' },
  { src: '/imagenes/gallery-5.jpg', titulo: 'Habitación Deluxe', descripcion: 'Comodidad premium', categoria: 'habitaciones', size: 'normal' },
  { src: '/imagenes/gallery-6.jpg', titulo: 'Spa & Masajes', descripcion: 'Rejuvenece cuerpo y mente', categoria: 'spa', size: 'normal' },
  { src: '/imagenes/gallery-7.jpg', titulo: 'Bar Lounge', descripcion: 'Cócteles artesanales', categoria: 'restaurante', size: 'normal' },
  { src: '/imagenes/gallery-8.jpg', titulo: 'Gimnasio', descripcion: 'Equipamiento de última generación', categoria: 'instalaciones', size: 'normal' },
  { src: '/imagenes/gallery-9.jpg', titulo: 'Suite Honeymoon', descripcion: 'El escenario perfecto para el romance', categoria: 'habitaciones', size: 'large' },
  { src: '/imagenes/gallery-10.jpg', titulo: 'Sauna', descripcion: 'Terapia de calor y relajación', categoria: 'spa', size: 'normal' },
  { src: '/imagenes/gallery-11.jpg', titulo: 'Terraza', descripcion: 'Vistas panorámicas de la ciudad', categoria: 'instalaciones', size: 'tall' },
  { src: '/imagenes/gallery-12.jpg', titulo: 'Desayuno Buffet', descripcion: 'Variedad gastronómica internacional', categoria: 'restaurante', size: 'normal' },
];

const imagenesFiltradas = computed(() => {
  if (categoriaActiva.value === 'todas') {
    return galeria;
  }
  return galeria.filter(img => img.categoria === categoriaActiva.value);
});

const abrirModal = (index: number) => {
  indiceModal.value = index;
  modalAbierto.value = true;
  document.body.style.overflow = 'hidden';
};

const cerrarModal = () => {
  modalAbierto.value = false;
  document.body.style.overflow = '';
};

const navegarModal = (direccion: number) => {
  indiceModal.value += direccion;
};
</script>

<style scoped>
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.animate-fadeIn {
  animation: fadeIn 0.3s ease-out;
}
</style>