<template>
  <section 
    id="servicios"
    class="py-20 bg-white dark:bg-gray-900"
  >
    <div class="mx-auto max-w-[1400px] px-6">
      <!-- Header -->
      <div class="mb-16 text-center">
        <span class="inline-block mb-4 text-amber-600 dark:text-amber-400 font-semibold text-sm tracking-wider uppercase">
          Servicios Premium
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
          Todo lo que Necesitas, en un Solo Lugar
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
          Disfruta de nuestras instalaciones de clase mundial y servicios diseñados para hacer tu estancia inolvidable.
        </p>
      </div>

      <!-- Grid de servicios principales -->
      <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 mb-16">
        <div 
          v-for="(servicio, index) in serviciosPrincipales" 
          :key="index"
          class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-50 to-white 
                 dark:from-gray-800 dark:to-gray-700 p-8 shadow-lg hover:shadow-2xl 
                 transition-all duration-500 border border-gray-100 dark:border-gray-600
                 hover:border-amber-400 dark:hover:border-amber-500"
        >
          <!-- Icono con animación -->
          <div class="mb-6 inline-flex items-center justify-center w-16 h-16 rounded-2xl 
                      bg-gradient-to-br from-amber-400 to-amber-600 text-white
                      shadow-lg group-hover:scale-110 transition-transform duration-300">
            <component :is="servicio.icon" class="w-8 h-8" />
          </div>

          <!-- Contenido -->
          <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">
            {{ servicio.titulo }}
          </h3>
          <p class="text-gray-600 dark:text-gray-300 mb-4">
            {{ servicio.descripcion }}
          </p>

          <!-- Lista de características -->
          <ul class="space-y-2">
            <li 
              v-for="(item, i) in servicio.items" 
              :key="i"
              class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300"
            >
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-amber-500 flex-shrink-0">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
              </svg>
              <span>{{ item }}</span>
            </li>
          </ul>

          <!-- Decoración de fondo -->
          <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-amber-400/10 dark:bg-amber-400/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
        </div>
      </div>

      <!-- Servicios adicionales -->
      <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-3xl p-8 md:p-12 text-white">
        <div class="mb-8 text-center">
          <h3 class="text-3xl font-bold mb-3">Servicios Complementarios</h3>
          <p class="text-amber-100 max-w-2xl mx-auto">
            Hacemos que tu estancia sea perfecta con estos servicios adicionales
          </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
          <div 
            v-for="(extra, index) in serviciosExtras" 
            :key="index"
            class="flex items-start gap-4 bg-white/10 backdrop-blur-sm rounded-xl p-5 
                   hover:bg-white/20 transition-all duration-300 border border-white/20"
          >
            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
              <component :is="extra.icon" class="w-6 h-6" />
            </div>
            <div>
              <h4 class="font-semibold mb-1">{{ extra.titulo }}</h4>
              <p class="text-sm text-amber-100">{{ extra.descripcion }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Horarios de servicios -->
      <div class="mt-16 grid gap-8 md:grid-cols-2">
        <!-- Restaurante -->
        <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 border border-gray-200 dark:border-gray-700">
          <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 rounded-full bg-amber-500 flex items-center justify-center">
              <Coffee class="w-7 h-7 text-white" />
            </div>
            <div>
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Restaurante & Bar</h3>
              <p class="text-gray-600 dark:text-gray-300">Gastronomía de primera clase</p>
            </div>
          </div>
          <div class="space-y-3">
            <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-700">
              <span class="font-medium text-gray-700 dark:text-gray-300">Desayuno</span>
              <span class="text-gray-600 dark:text-gray-400">7:00 AM - 11:00 AM</span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-700">
              <span class="font-medium text-gray-700 dark:text-gray-300">Almuerzo</span>
              <span class="text-gray-600 dark:text-gray-400">12:00 PM - 4:00 PM</span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-700">
              <span class="font-medium text-gray-700 dark:text-gray-300">Cena</span>
              <span class="text-gray-600 dark:text-gray-400">6:00 PM - 11:00 PM</span>
            </div>
            <div class="flex justify-between items-center py-3">
              <span class="font-medium text-gray-700 dark:text-gray-300">Bar</span>
              <span class="text-gray-600 dark:text-gray-400">5:00 PM - 2:00 AM</span>
            </div>
          </div>
        </div>

        <!-- Spa & Wellness -->
        <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 border border-gray-200 dark:border-gray-700">
          <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 rounded-full bg-amber-500 flex items-center justify-center">
              <Bath class="w-7 h-7 text-white" />
            </div>
            <div>
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Spa & Wellness</h3>
              <p class="text-gray-600 dark:text-gray-300">Relájate y rejuvenece</p>
            </div>
          </div>
          <div class="space-y-3">
            <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-700">
              <span class="font-medium text-gray-700 dark:text-gray-300">Spa</span>
              <span class="text-gray-600 dark:text-gray-400">9:00 AM - 9:00 PM</span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-700">
              <span class="font-medium text-gray-700 dark:text-gray-300">Gimnasio</span>
              <span class="text-gray-600 dark:text-gray-400">24 horas</span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-700">
              <span class="font-medium text-gray-700 dark:text-gray-300">Piscina</span>
              <span class="text-gray-600 dark:text-gray-400">6:00 AM - 10:00 PM</span>
            </div>
            <div class="flex justify-between items-center py-3">
              <span class="font-medium text-gray-700 dark:text-gray-300">Sauna</span>
              <span class="text-gray-600 dark:text-gray-400">7:00 AM - 10:00 PM</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { 
  Coffee, Dumbbell, Wifi, Car, Bath, UtensilsCrossed, 
  ShieldCheck, Headphones, Luggage, MapPin, Gift, Sparkles 
} from "lucide-vue-next";

const serviciosPrincipales = [
  {
    titulo: "Restaurante Gourmet",
    descripcion: "Deléitate con nuestra cocina internacional de alta calidad preparada por chefs expertos.",
    icon: UtensilsCrossed,
    items: [
      "Desayuno buffet incluido",
      "Menú internacional",
      "Servicio a la habitación 24/7",
      "Bar y lounge premium"
    ]
  },
  {
    titulo: "Spa & Wellness",
    descripcion: "Relájate en nuestro spa de lujo con tratamientos de clase mundial y personal profesional.",
    icon: Bath,
    items: [
      "Masajes terapéuticos",
      "Sauna y baño turco",
      "Piscina climatizada",
      "Gimnasio equipado"
    ]
  },
  {
    titulo: "Centro de Negocios",
    descripcion: "Instalaciones modernas para reuniones de trabajo y eventos corporativos.",
    icon: Wifi,
    items: [
      "Salas de conferencias",
      "WiFi de alta velocidad",
      "Servicios de secretariado",
      "Equipamiento audiovisual"
    ]
  },
  {
    titulo: "Gimnasio 24/7",
    descripcion: "Mantente en forma con nuestro gimnasio completamente equipado disponible todo el día.",
    icon: Dumbbell,
    items: [
      "Equipos de última generación",
      "Clases de yoga y pilates",
      "Entrenador personal",
      "Zona de cardio"
    ]
  },
  {
    titulo: "Estacionamiento",
    descripcion: "Estacionamiento privado y seguro para tu vehículo con servicio de valet parking.",
    icon: Car,
    items: [
      "Valet parking gratuito",
      "Seguridad 24 horas",
      "Espacios cubiertos",
      "Carga para vehículos eléctricos"
    ]
  },
  {
    titulo: "Concierge Premium",
    descripcion: "Nuestro equipo está disponible para ayudarte con cualquier solicitud o recomendación.",
    icon: ShieldCheck,
    items: [
      "Asistencia personalizada",
      "Reservas de tours",
      "Recomendaciones locales",
      "Servicio multilingüe"
    ]
  }
];

const serviciosExtras = [
  {
    titulo: "Traslados",
    descripcion: "Al aeropuerto y ciudad",
    icon: Car
  },
  {
    titulo: "Lavandería",
    descripcion: "Servicio express",
    icon: Sparkles
  },
  {
    titulo: "Custodia",
    descripcion: "Equipaje seguro",
    icon: Luggage
  },
  {
    titulo: "Tours",
    descripcion: "Excursiones guiadas",
    icon: MapPin
  },
  {
    titulo: "Atención 24/7",
    descripcion: "Siempre disponibles",
    icon: Headphones
  },
  {
    titulo: "Eventos",
    descripcion: "Bodas y celebraciones",
    icon: Gift
  },
  {
    titulo: "Room Service",
    descripcion: "A cualquier hora",
    icon: Coffee
  },
  {
    titulo: "WiFi Premium",
    descripcion: "Alta velocidad",
    icon: Wifi
  }
];
</script>