<template>
  <section 
    id="habitaciones"
    class="py-20 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800"
  >
    <div class="mx-auto max-w-[1400px] px-6">
      <!-- Header -->
      <div class="mb-16 text-center">
        <span class="inline-block mb-4 text-amber-600 dark:text-amber-400 font-semibold text-sm tracking-wider uppercase">
          Nuestras Habitaciones
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
          Espacios Diseñados Para Tu Comodidad
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
          Cada habitación ha sido cuidadosamente diseñada para ofrecerte la máxima comodidad y elegancia.
        </p>
      </div>

      <!-- Grid de habitaciones -->
      <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        <div 
          v-for="(room, index) in habitaciones" 
          :key="index"
          class="group relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 
                 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
        >
          <!-- Imagen -->
          <div class="relative h-64 overflow-hidden">
            <img 
              :src="room.imagen" 
              :alt="room.nombre"
              class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <!-- Badge de precio -->
            <div class="absolute top-4 right-4 bg-amber-500 text-white px-4 py-2 rounded-full font-bold shadow-lg">
              S/.{{ room.precio }}<span class="text-sm font-normal">/noche</span>
            </div>

            <!-- Badge de popularidad (opcional) -->
            <div v-if="room.popular" class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
              ⭐ Más Popular
            </div>
          </div>

          <!-- Contenido -->
          <div class="p-6">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
              {{ room.nombre }}
            </h3>
            <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
              {{ room.descripcion }}
            </p>

            <!-- Características -->
            <div class="grid grid-cols-2 gap-3 mb-6">
              <div 
                v-for="(caracteristica, i) in room.caracteristicas" 
                :key="i"
                class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300"
              >
                <component :is="caracteristica.icon" class="w-4 h-4 text-amber-600 dark:text-amber-400 flex-shrink-0" />
                <span>{{ caracteristica.texto }}</span>
              </div>
            </div>

            <!-- Botón -->
            <button 
              @click="seleccionarHabitacion()"
              class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 
                     hover:from-amber-600 hover:to-amber-700 text-white px-6 py-3 rounded-lg 
                     shadow-md hover:shadow-lg transition-all duration-300 font-semibold group/btn"
            >
              <span>Reservar Ahora</span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform">
                <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Beneficios adicionales -->
      <div class="mt-16 grid gap-6 md:grid-cols-4 bg-gradient-to-r from-amber-50 to-amber-100 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-8">
        <div 
          v-for="(beneficio, index) in beneficios" 
          :key="index"
          class="text-center"
        >
          <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-amber-500 text-white mb-4">
            <component :is="beneficio.icon" class="w-7 h-7" />
          </div>
          <h4 class="font-semibold text-gray-900 dark:text-white mb-1">{{ beneficio.titulo }}</h4>
          <p class="text-sm text-gray-600 dark:text-gray-300">{{ beneficio.descripcion }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { Users, Wifi, Coffee, Tv, Bath, Wind, Shield, Clock } from "lucide-vue-next";

const habitaciones = [
  {
    nombre: "Suite Ejecutiva",
    descripcion: "Perfecta para viajeros de negocios que buscan confort y productividad.",
    precio: 150,
    imagen: "/imagenes/room-executive.jpg",
    popular: false,
    caracteristicas: [
      { icon: Users, texto: "2 personas" },
      { icon: Wifi, texto: "WiFi gratis" },
      { icon: Coffee, texto: "Minibar" },
      { icon: Tv, texto: "Smart TV 55\"" },
    ]
  },
  {
    nombre: "Habitación Deluxe",
    descripcion: "Espaciosa y elegante, ideal para parejas que buscan una experiencia premium.",
    precio: 200,
    imagen: "/imagenes/room-deluxe.jpg",
    popular: true,
    caracteristicas: [
      { icon: Users, texto: "2-3 personas" },
      { icon: Bath, texto: "Jacuzzi" },
      { icon: Wind, texto: "Aire acondicionado" },
      { icon: Coffee, texto: "Desayuno incluido" },
    ]
  },
  {
    nombre: "Suite Presidencial",
    descripcion: "La máxima expresión de lujo con vistas panorámicas y servicio personalizado.",
    precio: 350,
    imagen: "/imagenes/room-presidential.jpg",
    popular: false,
    caracteristicas: [
      { icon: Users, texto: "4 personas" },
      { icon: Bath, texto: "Spa privado" },
      { icon: Tv, texto: "Cine en casa" },
      { icon: Coffee, texto: "Servicio 24h" },
    ]
  },
  {
    nombre: "Habitación Familiar",
    descripcion: "Diseñada para familias, con espacio amplio y todas las comodidades necesarias.",
    precio: 180,
    imagen: "/imagenes/room-family.jpg",
    popular: false,
    caracteristicas: [
      { icon: Users, texto: "4-5 personas" },
      { icon: Wifi, texto: "WiFi alta velocidad" },
      { icon: Tv, texto: "2 Smart TVs" },
      { icon: Coffee, texto: "Cocina básica" },
    ]
  },
  {
    nombre: "Habitación Económica",
    descripcion: "Confortable y funcional, perfecta para estancias cortas con excelente relación calidad-precio.",
    precio: 90,
    imagen: "/imagenes/room-economy.jpg",
    popular: false,
    caracteristicas: [
      { icon: Users, texto: "2 personas" },
      { icon: Wifi, texto: "WiFi gratis" },
      { icon: Wind, texto: "Ventilador" },
      { icon: Tv, texto: "TV cable" },
    ]
  },
  {
    nombre: "Suite Honeymoon",
    descripcion: "Romántica y acogedora, perfecta para lunas de miel con detalles especiales.",
    precio: 250,
    imagen: "/imagenes/room-honeymoon.jpg",
    popular: true,
    caracteristicas: [
      { icon: Users, texto: "2 personas" },
      { icon: Bath, texto: "Bañera hidromasaje" },
      { icon: Coffee, texto: "Champagne incluido" },
      { icon: Tv, texto: "Decoración especial" },
    ]
  },
];

const beneficios = [
  {
    icon: Shield,
    titulo: "Cancelación Gratis",
    descripcion: "Hasta 48h antes"
  },
  {
    icon: Wifi,
    titulo: "WiFi Premium",
    descripcion: "En todas las habitaciones"
  },
  {
    icon: Coffee,
    titulo: "Desayuno",
    descripcion: "Buffet incluido"
  },
  {
    icon: Clock,
    titulo: "Check-in Flexible",
    descripcion: "A cualquier hora"
  },
];

const seleccionarHabitacion = () => {
  // Redirigir a la sección de reservas con la habitación seleccionada
  window.location.href = `#contacto`;
};
</script>