<template>
  <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-gray-300">
    <!-- Contenido principal del footer -->
    <div class="mx-auto max-w-[1400px] px-6 py-16">
      <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-4">
        <!-- Columna 1: Información del hotel -->
        <div>
          <div class="mb-6 flex items-center gap-3">
            <img src="/imagenes/LigthL.png" alt="Hotel Logo" class="h-12 w-12" />
            <div>
              <h3 class="text-xl font-bold text-white">Hotel Nuevo</h3>
              <p class="text-xs text-amber-400">Luxury & Comfort</p>
            </div>
          </div>
          <p class="mb-6 text-sm leading-relaxed">
            Experimenta el lujo y la hospitalidad excepcional en el corazón de la ciudad. 
            Tu confort es nuestra prioridad.
          </p>
          <div class="flex gap-3">
            <a 
              v-for="social in redes" 
              :key="social.name"
              :href="social.url" 
              target="_blank"
              rel="noopener noreferrer"
              class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-700 
                     hover:bg-amber-500 transition-all duration-300 transform hover:scale-110"
              :aria-label="social.name"
            >
              <component :is="social.icon" class="h-5 w-5" />
            </a>
          </div>
        </div>

        <!-- Columna 2: Enlaces rápidos -->
        <div>
          <h4 class="mb-6 text-lg font-bold text-white">Enlaces Rápidos</h4>
          <ul class="space-y-3">
            <li v-for="link in enlacesRapidos" :key="link.text">
              <a 
                :href="link.href" 
                class="group flex items-center gap-2 text-sm hover:text-amber-400 transition-colors"
              >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" 
                     class="w-4 h-4 group-hover:translate-x-1 transition-transform">
                  <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                </svg>
                {{ link.text }}
              </a>
            </li>
          </ul>
        </div>

        <!-- Columna 3: Servicios -->
        <div>
          <h4 class="mb-6 text-lg font-bold text-white">Nuestros Servicios</h4>
          <ul class="space-y-3">
            <li v-for="servicio in servicios" :key="servicio">
              <a 
                href="#servicios" 
                class="group flex items-center gap-2 text-sm hover:text-amber-400 transition-colors"
              >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" 
                     class="w-4 h-4 text-amber-500">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
                {{ servicio }}
              </a>
            </li>
          </ul>
        </div>

        <!-- Columna 4: Contacto y Newsletter -->
        <div>
          <h4 class="mb-6 text-lg font-bold text-white">Mantente Conectado</h4>
          <div class="space-y-4 mb-6">
            <div class="flex items-start gap-3">
              <MapPin class="h-5 w-5 text-amber-500 flex-shrink-0 mt-0.5" />
              <p class="text-sm">Av. Principal 123, Miraflores, Lima, Perú</p>
            </div>
            <div class="flex items-start gap-3">
              <Phone class="h-5 w-5 text-amber-500 flex-shrink-0 mt-0.5" />
              <div class="text-sm">
                <p>+51 1 234 5678</p>
                <p>+51 987 654 321</p>
              </div>
            </div>
            <div class="flex items-start gap-3">
              <Mail class="h-5 w-5 text-amber-500 flex-shrink-0 mt-0.5" />
              <p class="text-sm">reservas@hotelnuevo.com</p>
            </div>
          </div>

          <!-- Newsletter -->
          <div class="rounded-xl bg-gray-800/50 p-4 border border-gray-700">
            <h5 class="mb-3 text-sm font-semibold text-white">Suscríbete a nuestro Newsletter</h5>
            <form @submit.prevent="suscribirse" class="flex gap-2">
              <input
                v-model="emailNewsletter"
                type="email"
                placeholder="Tu email"
                required
                class="flex-1 rounded-lg bg-gray-700 px-3 py-2 text-sm text-white 
                       placeholder-gray-400 border border-gray-600 focus:border-amber-500 
                       focus:ring-1 focus:ring-amber-500 outline-none transition-all"
              />
              <button
                type="submit"
                class="rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 
                       hover:from-amber-600 hover:to-amber-700 px-4 py-2 text-sm 
                       font-semibold text-white transition-all transform hover:scale-105"
              >
                Enviar
              </button>
            </form>
            <p v-if="mensajeNewsletter" class="mt-2 text-xs text-green-400">
              {{ mensajeNewsletter }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Certificaciones y premios -->
    <div class="border-t border-gray-700">
      <div class="mx-auto max-w-[1400px] px-6 py-8">
        <div class="flex flex-wrap justify-center gap-8 items-center">
          <div class="flex items-center gap-2 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-amber-400">
              <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
            </svg>
            <span>Hotel 5 Estrellas</span>
          </div>
          <div class="flex items-center gap-2 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-amber-400">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
            </svg>
            <span>Certificado ISO 9001</span>
          </div>
          <div class="flex items-center gap-2 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-green-400">
              <path d="M10.75 10.818v2.614A3.13 3.13 0 0011.888 13c.482-.315.612-.648.612-.875 0-.227-.13-.56-.612-.875a3.13 3.13 0 00-1.138-.432zM8.33 8.62c.053.055.115.11.184.164.208.16.46.284.736.363V6.603a2.45 2.45 0 00-.35.13c-.14.065-.27.143-.386.233-.377.292-.514.627-.514.909 0 .184.058.39.202.592.037.051.08.102.128.152z" />
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-6a.75.75 0 01.75.75v.316a3.78 3.78 0 011.653.713c.426.33.744.74.925 1.2a.75.75 0 01-1.395.55 1.35 1.35 0 00-.447-.563 2.187 2.187 0 00-.736-.363V9.3c.698.093 1.383.32 1.959.696.787.514 1.29 1.27 1.29 2.13 0 .86-.504 1.616-1.29 2.13-.576.377-1.261.603-1.96.696v.299a.75.75 0 11-1.5 0v-.3c-.697-.092-1.382-.318-1.958-.695-.482-.315-.857-.717-1.078-1.188a.75.75 0 111.359-.636c.08.173.245.376.54.569.313.205.706.353 1.138.432v-2.748a3.782 3.782 0 01-1.653-.713C6.9 9.433 6.5 8.681 6.5 7.875c0-.805.4-1.558 1.097-2.096a3.78 3.78 0 011.653-.713V4.75A.75.75 0 0110 4z" clip-rule="evenodd" />
            </svg>
            <span>Sostenibilidad Ambiental</span>
          </div>
          <div class="flex items-center gap-2 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-amber-400">
              <path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 00-1.905 3.959c-.023.222-.014.442.025.654a4.97 4.97 0 01-2.07-.655zM16.44 15.98a4.97 4.97 0 002.07-.654.78.78 0 00.357-.442 3 3 0 00-4.308-3.517 6.484 6.484 0 011.907 3.96 2.32 2.32 0 01-.026.654zM18 8a2 2 0 11-4 0 2 2 0 014 0zM5.304 16.19a.844.844 0 01-.277-.71 5 5 0 019.947 0 .843.843 0 01-.277.71A6.975 6.975 0 0110 18a6.974 6.974 0 01-4.696-1.81z" />
            </svg>
            <span>Mejor Servicio al Cliente 2024</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <div class="border-t border-gray-700">
      <div class="mx-auto max-w-[1400px] px-6 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
          <p>© 2025 Hotel Nuevo. Todos los derechos reservados.</p>
          <div class="flex gap-6">
            <a href="#" class="hover:text-amber-400 transition-colors">Términos y Condiciones</a>
            <a href="#" class="hover:text-amber-400 transition-colors">Política de Privacidad</a>
            <a href="#" class="hover:text-amber-400 transition-colors">Política de Cookies</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Facebook, Instagram, Twitter, Linkedin, MapPin, Phone, Mail } from 'lucide-vue-next';

const emailNewsletter = ref('');
const mensajeNewsletter = ref('');

const redes = [
  { name: 'Facebook', url: 'https://facebook.com', icon: Facebook },
  { name: 'Instagram', url: 'https://instagram.com', icon: Instagram },
  { name: 'Twitter', url: 'https://twitter.com', icon: Twitter },
  { name: 'LinkedIn', url: 'https://linkedin.com', icon: Linkedin },
];

const enlacesRapidos = [
  { text: 'Inicio', href: '#inicio' },
  { text: 'Habitaciones', href: '#habitaciones' },
  { text: 'Servicios', href: '#servicios' },
  { text: 'Galería', href: '#galeria' },
  { text: 'Testimonios', href: '#testimonios' },
  { text: 'Preguntas', href: '#faqs' },
  { text: 'Contacto', href: '#contacto' },
];

const servicios = [
  'Restaurante Gourmet',
  'Spa & Wellness',
  'Gimnasio 24/7',
  'Piscina Infinity',
  'Centro de Negocios',
  'Servicio de Habitaciones',
  'Estacionamiento Valet',
  'Traslados al Aeropuerto',
];

const suscribirse = () => {
  // Aquí iría la lógica para suscribirse al newsletter
  mensajeNewsletter.value = '✅ ¡Gracias por suscribirte!';
  emailNewsletter.value = '';
  
  setTimeout(() => {
    mensajeNewsletter.value = '';
  }, 3000);
};
</script>