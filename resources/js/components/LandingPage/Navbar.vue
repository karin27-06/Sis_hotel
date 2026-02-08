<template>
  <nav class="fixed top-0 left-0 z-50 w-full bg-white/95 backdrop-blur-sm shadow-md dark:bg-gray-900/95 transition-all duration-300">
    <div class="mx-auto flex max-w-[1400px] items-center justify-between px-6 py-4">
      <!-- Logo -->
      <a href="#inicio" class="flex items-center space-x-3 group">
        <div class="relative">
<img :src="logoSrc" class="h-16 w-16 object-contain" />
        </div>
        <div class="flex flex-col">
          <span class="text-xl font-bold text-amber-600 dark:text-amber-400 tracking-wide">
            Hotel Nuevo
          </span>
          <span class="text-xs text-gray-500 dark:text-gray-400">Luxury & Comfort</span>
        </div>
      </a>

      <!-- Menú de escritorio -->
      <div class="hidden items-center space-x-8 lg:flex">
        <NavigationMenu>
          <NavigationMenuList class="flex space-x-1">
            <NavigationMenuItem v-for="link in links" :key="link.text">
              <NavigationMenuLink
                :href="link.href"
                class="px-4 py-2 rounded-lg text-gray-700 hover:text-amber-600 hover:bg-amber-50 
                       transition-all duration-200 font-medium
                       dark:text-gray-200 dark:hover:text-amber-400 dark:hover:bg-gray-800"
              >
                {{ link.text }}
              </NavigationMenuLink>
            </NavigationMenuItem>
          </NavigationMenuList>
        </NavigationMenu>

        <!-- Botón de modo oscuro -->
        <button
          @click="toggleTheme"
          class="rounded-full p-2.5 hover:scale-110 transition-all duration-200 
                 bg-gray-100 dark:bg-gray-800 hover:bg-amber-50 dark:hover:bg-gray-700"
          :aria-label="isDark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'"
        >
          <component :is="isDark ? Sun : Moon" class="w-5 h-5 text-amber-600 dark:text-amber-400" />
        </button>

        <!-- Botón de Intranet -->
        <a 
          href="/login" 
          class="ml-2 flex items-center gap-2 text-gray-700 hover:text-amber-600 
                 dark:text-gray-200 dark:hover:text-amber-400 font-medium transition-colors"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" />
          </svg>
          <span>Intranet</span>
        </a>

        <!-- Botón de Reservar -->
        <a 
          href="#contacto" 
          class="ml-2 flex items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 
                 hover:from-amber-600 hover:to-amber-700 text-white px-6 py-2.5 rounded-full 
                 shadow-lg hover:shadow-xl transition-all duration-200 font-semibold"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
            <path d="M5.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H6a.75.75 0 01-.75-.75V12zM6 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H6zM7.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H8a.75.75 0 01-.75-.75V12zM8 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H8zM9.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V10zM10 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H10zM9.25 14a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V14zM12 9.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V10a.75.75 0 00-.75-.75H12zM11.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H12a.75.75 0 01-.75-.75V12zM12 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H12zM13.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H14a.75.75 0 01-.75-.75V10zM14 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H14z" />
            <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
          </svg>
          Reservar Ahora
        </a>
      </div>

      <!-- Botón hamburguesa móvil -->
      <button @click="menuOpen = !menuOpen" class="text-gray-800 dark:text-gray-200 lg:hidden p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition">
        <svg v-if="!menuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg v-else class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Menú móvil -->
    <div 
      v-if="menuOpen" 
      class="px-6 pb-6 pt-4 md:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700
             animate-slideDown"
    >
      <NavigationMenu>
        <NavigationMenuList class="flex flex-col items-start space-y-2">
          <NavigationMenuItem v-for="link in links" :key="link.text + '-mobile'" class="w-full">
            <NavigationMenuLink
              :href="link.href"
              @click="menuOpen = false"
              class="block w-full px-4 py-3 rounded-lg text-gray-700 hover:text-amber-600 hover:bg-amber-50 
                     dark:text-gray-200 dark:hover:text-amber-400 dark:hover:bg-gray-800 transition-all"
            >
              {{ link.text }}
            </NavigationMenuLink>
          </NavigationMenuItem>

          <NavigationMenuItem class="w-full pt-2 border-t border-gray-200 dark:border-gray-700">
            <button
              @click="toggleTheme"
              class="w-full flex items-center justify-between gap-2 rounded-lg px-4 py-3 
                     bg-gray-100 dark:bg-gray-800 hover:bg-amber-50 dark:hover:bg-gray-700 transition"
            >
              <span class="font-medium">{{ isDark ? 'Modo claro' : 'Modo oscuro' }}</span>
              <component :is="isDark ? Sun : Moon" class="w-5 h-5 text-amber-600 dark:text-amber-400" />
            </button>
          </NavigationMenuItem>

          <NavigationMenuItem class="w-full">
            <a 
              href="/login" 
              @click="menuOpen = false"
              class="flex items-center gap-3 w-full px-4 py-3 rounded-lg text-gray-700 
                     hover:text-amber-600 hover:bg-amber-50 dark:text-gray-200 
                     dark:hover:text-amber-400 dark:hover:bg-gray-800 transition-all font-medium"
            >
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" />
              </svg>
              <span>Intranet</span>
            </a>
          </NavigationMenuItem>

          <NavigationMenuItem class="w-full">
            <a 
              href="#contacto" 
              @click="menuOpen = false"
              class="flex items-center justify-center gap-2 w-full bg-gradient-to-r from-amber-500 to-amber-600 
                     text-white px-6 py-3 rounded-lg shadow-lg font-semibold transition-all hover:shadow-xl"
            >
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
              </svg>
              Reservar Ahora
            </a>
          </NavigationMenuItem>
        </NavigationMenuList>
      </NavigationMenu>
    </div>
  </nav>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from "vue";
import { Moon, Sun } from "lucide-vue-next";
import {
  NavigationMenu,
  NavigationMenuList,
  NavigationMenuItem,
  NavigationMenuLink,
} from "@/components/ui/navigation-menu";

const menuOpen = ref<boolean>(false);
const isDark = ref<boolean>(false);

const logoSrc = computed(() => (isDark.value ? "/imagenes/DarkL.png" : "/imagenes/LigthL.png"));

onMounted(() => {
  const html = document.documentElement;
  const storedTheme = localStorage.getItem("theme");
  const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;

  isDark.value = storedTheme === "dark" || (!storedTheme && prefersDark);
  html.classList.toggle("app-dark", isDark.value);
});

const toggleTheme = (): void => {
  const html = document.documentElement;
  isDark.value = !isDark.value;
  html.classList.toggle("app-dark", isDark.value);
  localStorage.setItem("theme", isDark.value ? "dark" : "light");
};

const links = [
  { text: "Inicio", href: "#inicio" },
  { text: "Habitaciones", href: "#habitaciones" },
  { text: "Servicios", href: "#servicios" },
  { text: "Galería", href: "#galeria" },
  { text: "Testimonios", href: "#testimonios" },
  { text: "Preguntas", href: "#faqs"},
  { text: "Contacto", href: "#contacto" },
];
</script>

<style scoped>
@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-slideDown {
  animation: slideDown 0.3s ease-out;
}
</style>