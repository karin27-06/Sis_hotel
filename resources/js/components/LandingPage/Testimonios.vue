<template>
  <section 
    id="testimonios"
    class="py-20 bg-white dark:bg-gray-900"
  >
    <div class="mx-auto max-w-[1400px] px-6">
      <!-- Header -->
      <div class="mb-16 text-center">
        <span class="inline-block mb-4 text-amber-600 dark:text-amber-400 font-semibold text-sm tracking-wider uppercase">
          Testimonios
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
          Lo Que Dicen Nuestros Huéspedes
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
          Miles de clientes satisfechos comparten su experiencia en Hotel Nuevo
        </p>
      </div>

      <!-- Estadísticas -->
      <div class="grid gap-8 md:grid-cols-4 mb-16">
        <div 
          v-for="(stat, index) in estadisticas" 
          :key="index"
          class="text-center p-6 bg-gradient-to-br from-amber-50 to-amber-100 
                 dark:from-gray-800 dark:to-gray-700 rounded-2xl"
        >
          <div class="text-4xl md:text-5xl font-bold text-amber-600 dark:text-amber-400 mb-2">
            {{ stat.valor }}
          </div>
          <div class="text-gray-700 dark:text-gray-300 font-medium">
            {{ stat.label }}
          </div>
        </div>
      </div>

      <!-- Carrusel de testimonios -->
      <div class="relative">
        <div class="overflow-hidden">
          <div 
            class="flex transition-transform duration-700 ease-in-out"
            :style="{ transform: `translateX(-${currentTestimonio * 100}%)` }"
          >
            <div
              v-for="(testimonio, index) in testimonios"
              :key="index"
              class="min-w-full px-4"
            >
              <div class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-700 
                          rounded-3xl p-8 md:p-12 shadow-xl border border-gray-200 dark:border-gray-600">
                <div class="flex flex-col md:flex-row gap-8 items-center">
                  <!-- Imagen del cliente -->
                  <div class="flex-shrink-0">
                    <div class="relative">
                      <img
                        :src="testimonio.foto"
                        :alt="testimonio.nombre"
                        class="w-32 h-32 rounded-full object-cover border-4 border-amber-400 shadow-lg"
                      />
                      <div class="absolute -bottom-2 -right-2 w-12 h-12 bg-amber-500 rounded-full 
                                  flex items-center justify-center border-4 border-white dark:border-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-white">
                          <path d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" />
                        </svg>
                      </div>
                    </div>
                  </div>

                  <!-- Contenido del testimonio -->
                  <div class="flex-1 text-center md:text-left">
                    <!-- Estrellas -->
                    <div class="flex justify-center md:justify-start gap-1 mb-4">
                      <svg
                        v-for="i in 5"
                        :key="i"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="w-6 h-6 text-amber-400"
                      >
                        <path d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" />
                      </svg>
                    </div>

                    <!-- Texto del testimonio -->
                    <blockquote class="text-xl md:text-2xl text-gray-700 dark:text-gray-200 mb-6 leading-relaxed italic">
                      "{{ testimonio.texto }}"
                    </blockquote>

                    <!-- Información del cliente -->
                    <div>
                      <div class="font-bold text-lg text-gray-900 dark:text-white">
                        {{ testimonio.nombre }}
                      </div>
                      <div class="text-gray-600 dark:text-gray-400">
                        {{ testimonio.ubicacion }} • {{ testimonio.fecha }}
                      </div>
                      <div class="mt-2 inline-flex items-center gap-2 text-sm text-amber-600 dark:text-amber-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                        <span>Estadía verificada</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Controles del carrusel -->
        <div class="flex justify-center items-center gap-6 mt-8">
          <button
            @click="prevTestimonio"
            class="w-12 h-12 rounded-full bg-gradient-to-r from-amber-500 to-amber-600 
                   hover:from-amber-600 hover:to-amber-700 text-white flex items-center 
                   justify-center shadow-lg hover:shadow-xl transition-all duration-300
                   transform hover:scale-110"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
            </svg>
          </button>

          <!-- Indicadores -->
          <div class="flex gap-2">
            <button
              v-for="(_, index) in testimonios"
              :key="index"
              @click="currentTestimonio = index"
              :class="[
                'h-2 rounded-full transition-all duration-300',
                currentTestimonio === index 
                  ? 'w-8 bg-amber-500' 
                  : 'w-2 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400'
              ]"
            ></button>
          </div>

          <button
            @click="nextTestimonio"
            class="w-12 h-12 rounded-full bg-gradient-to-r from-amber-500 to-amber-600 
                   hover:from-amber-600 hover:to-amber-700 text-white flex items-center 
                   justify-center shadow-lg hover:shadow-xl transition-all duration-300
                   transform hover:scale-110"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Plataformas de reseñas -->
      <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div 
          v-for="(plataforma, index) in plataformas" 
          :key="index"
          class="flex flex-col items-center justify-center p-6 bg-gray-50 dark:bg-gray-800 
                 rounded-2xl border border-gray-200 dark:border-gray-700 hover:border-amber-400 
                 dark:hover:border-amber-500 transition-all duration-300"
        >
          <img :src="plataforma.logo" :alt="plataforma.nombre" class="h-8 mb-3 opacity-70" />
          <div class="flex items-center gap-2 mb-2">
            <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ plataforma.rating }}</span>
            <div class="flex">
              <svg
                v-for="i in 5"
                :key="i"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="w-4 h-4 text-amber-400"
              >
                <path d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" />
              </svg>
            </div>
          </div>
          <p class="text-sm text-gray-600 dark:text-gray-400">{{ plataforma.reseñas }} reseñas</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';

const currentTestimonio = ref(0);

const estadisticas = [
  { valor: '4.9', label: 'Calificación Promedio' },
  { valor: '10K+', label: 'Huéspedes Felices' },
  { valor: '98%', label: 'Recomendarían' },
  { valor: '2.5K+', label: 'Reseñas Positivas' },
];

const testimonios = [
  {
    nombre: 'María González',
    ubicacion: 'Madrid, España',
    fecha: 'Enero 2025',
    foto: '/imagenes/client-1.jpg',
    texto: 'Una experiencia absolutamente inolvidable. El servicio es impecable, las habitaciones son lujosas y la atención al detalle es excepcional. Sin duda volveremos para nuestro próximo aniversario.',
  },
  {
    nombre: 'John Smith',
    ubicacion: 'Nueva York, USA',
    fecha: 'Diciembre 2024',
    foto: '/imagenes/client-2.jpg',
    texto: 'He viajado por todo el mundo y este hotel está entre los mejores. La ubicación es perfecta, el personal es extremadamente profesional y las instalaciones son de primera clase. Altamente recomendado.',
  },
  {
    nombre: 'Sofia Rossi',
    ubicacion: 'Roma, Italia',
    fecha: 'Noviembre 2024',
    foto: '/imagenes/client-3.jpg',
    texto: 'El spa es maravilloso, la comida del restaurante es exquisita y la habitación superó todas nuestras expectativas. Cada momento fue especial. Es el lugar perfecto para una escapada romántica.',
  },
  {
    nombre: 'Carlos Mendoza',
    ubicacion: 'Buenos Aires, Argentina',
    fecha: 'Octubre 2024',
    foto: '/imagenes/client-4.jpg',
    texto: 'Vine por negocios y me sorprendió gratamente. El centro de negocios tiene todo lo necesario, el WiFi es excelente y el servicio a la habitación es rápido. Perfecto para viajeros corporativos.',
  },
  {
    nombre: 'Emma Chen',
    ubicacion: 'Singapur',
    fecha: 'Septiembre 2024',
    foto: '/imagenes/client-5.jpg',
    texto: 'La atención personalizada del concierge hizo que nuestra visita fuera perfecta. Nos ayudaron con todas nuestras reservas y recomendaciones. El desayuno buffet es increíble con opciones para todos.',
  },
];

const plataformas = [
  { nombre: 'TripAdvisor', logo: '/imagenes/tripadvisor-logo.png', rating: '4.9', reseñas: '2,847' },
  { nombre: 'Booking.com', logo: '/imagenes/booking-logo.png', rating: '9.2', reseñas: '3,156' },
  { nombre: 'Google', logo: '/imagenes/google-logo.png', rating: '4.8', reseñas: '1,923' },
  { nombre: 'Expedia', logo: '/imagenes/expedia-logo.png', rating: '4.7', reseñas: '1,542' },
];

const nextTestimonio = () => {
  currentTestimonio.value = (currentTestimonio.value + 1) % testimonios.length;
};

const prevTestimonio = () => {
  currentTestimonio.value = (currentTestimonio.value - 1 + testimonios.length) % testimonios.length;
};

let intervalId: number;
onMounted(() => {
  intervalId = window.setInterval(nextTestimonio, 7000);
});

onUnmounted(() => {
  clearInterval(intervalId);
});
</script>