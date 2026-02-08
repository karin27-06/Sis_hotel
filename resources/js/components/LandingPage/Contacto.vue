<template>
  <section 
    id="contacto" 
    class="py-20 bg-white dark:bg-gray-900"
  >
    <div class="mx-auto max-w-[1400px] px-6">
      <!-- Header -->
      <div class="mb-16 text-center">
        <span class="inline-block mb-4 text-amber-600 dark:text-amber-400 font-semibold text-sm tracking-wider uppercase">
          Contáctanos
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
          Estamos Aquí Para Ayudarte
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
          Nuestro equipo está disponible 24/7 para responder tus preguntas y asistirte con tu reserva
        </p>
      </div>

      <div class="grid lg:grid-cols-2 gap-12">
        <!-- Información de contacto -->
        <div class="space-y-6">
          <!-- Tarjetas de contacto -->
          <div
            v-for="(contacto, index) in contactos"
            :key="index"
            class="group flex items-start gap-5 p-6 bg-gradient-to-br from-gray-50 to-white 
                   dark:from-gray-800 dark:to-gray-700 rounded-2xl shadow-md hover:shadow-xl 
                   border-2 border-gray-200 dark:border-gray-600 hover:border-amber-400 
                   dark:hover:border-amber-500 transition-all duration-300"
          >
            <!-- Icono -->
            <div class="flex-shrink-0 w-14 h-14 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 
                        flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
              <component :is="contacto.icon" class="w-7 h-7 text-white" />
            </div>

            <!-- Contenido -->
            <div class="flex-1">
              <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                {{ contacto.title }}
              </h3>
              <div class="text-gray-600 dark:text-gray-300 space-y-1" v-html="contacto.info"></div>
              <a 
                v-if="contacto.action" 
                :href="contacto.action.link" 
                class="inline-flex items-center gap-2 mt-3 text-amber-600 dark:text-amber-400 
                       hover:text-amber-700 dark:hover:text-amber-300 font-semibold 
                       transition-colors group/link"
              >
                <span>{{ contacto.action.text }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" 
                     class="w-4 h-4 group-hover/link:translate-x-1 transition-transform">
                  <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                </svg>
              </a>
            </div>
          </div>

          <!-- Horarios de atención -->
          <div class="p-6 bg-gradient-to-br from-amber-50 to-amber-100 dark:from-gray-800 dark:to-gray-700 
                      rounded-2xl border-2 border-amber-200 dark:border-gray-600">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
              <Clock class="w-5 h-5 text-amber-600 dark:text-amber-400" />
              Horarios de Atención
            </h3>
            <div class="space-y-2 text-gray-700 dark:text-gray-300">
              <div class="flex justify-between">
                <span class="font-medium">Recepción:</span>
                <span>24 horas</span>
              </div>
              <div class="flex justify-between">
                <span class="font-medium">Reservas:</span>
                <span>Lun - Dom: 7:00 AM - 11:00 PM</span>
              </div>
              <div class="flex justify-between">
                <span class="font-medium">Atención telefónica:</span>
                <span>24/7</span>
              </div>
            </div>
          </div>

          <!-- Mapa (placeholder) -->
          <div class="relative h-64 rounded-2xl overflow-hidden shadow-lg border-2 border-gray-200 dark:border-gray-600">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.3!2d-77.0428!3d-12.0464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTLCsDAyJzQ3LjAiUyA3N8KwMDInMzQuMSJX!5e0!3m2!1ses!2spe!4v1234567890"
              width="100%"
              height="100%"
              style="border:0;"
              allowfullscreen
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              class="grayscale hover:grayscale-0 transition-all duration-300"
            ></iframe>
            <div class="absolute bottom-4 left-4 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm 
                        px-4 py-2 rounded-lg shadow-lg">
              <p class="text-sm font-semibold text-gray-900 dark:text-white">📍 Av. Principal 123, Lima</p>
            </div>
          </div>
        </div>

        <!-- Formulario de contacto -->
        <div>
          <div class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-700 
                      p-8 rounded-2xl shadow-xl border-2 border-gray-200 dark:border-gray-600">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
              Envíanos un Mensaje
            </h3>

            <form @submit.prevent="enviarFormulario" class="space-y-5">
              <!-- Nombre -->
              <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">
                  Nombre Completo *
                </label>
                <input 
                  v-model="form.first_name" 
                  type="text" 
                  required
                  placeholder="Ej: Juan Pérez"
                  class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 dark:border-gray-600 
                         bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                         focus:border-amber-500 dark:focus:border-amber-400 focus:ring-2 
                         focus:ring-amber-200 dark:focus:ring-amber-900/50 outline-none transition-all"
                />
              </div>

              <!-- Email -->
              <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">
                  Correo Electrónico *
                </label>
                <input 
                  v-model="form.email" 
                  type="email" 
                  required
                  placeholder="tu@email.com"
                  class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 dark:border-gray-600 
                         bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                         focus:border-amber-500 dark:focus:border-amber-400 focus:ring-2 
                         focus:ring-amber-200 dark:focus:ring-amber-900/50 outline-none transition-all"
                />
              </div>

              <!-- Teléfono -->
              <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">
                  Teléfono *
                </label>
                <input 
                  v-model="form.phone" 
                  type="tel" 
                  maxlength="15"
                  required
                  placeholder="+51 999 999 999"
                  class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 dark:border-gray-600 
                         bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                         focus:border-amber-500 dark:focus:border-amber-400 focus:ring-2 
                         focus:ring-amber-200 dark:focus:ring-amber-900/50 outline-none transition-all"
                />
              </div>

              <!-- Asunto -->
              <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">
                  Asunto
                </label>
                <select
                  v-model="form.asunto"
                  class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 dark:border-gray-600 
                         bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                         focus:border-amber-500 dark:focus:border-amber-400 focus:ring-2 
                         focus:ring-amber-200 dark:focus:ring-amber-900/50 outline-none transition-all"
                >
                  <option value="">Selecciona un asunto</option>
                  <option value="reserva">Nueva Reserva</option>
                  <option value="modificacion">Modificar Reserva</option>
                  <option value="evento">Eventos y Celebraciones</option>
                  <option value="corporativo">Servicios Corporativos</option>
                  <option value="otro">Otro</option>
                </select>
              </div>

              <!-- Mensaje -->
              <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">
                  Mensaje *
                </label>
                <textarea 
                  v-model="form.subject" 
                  rows="5" 
                  required
                  placeholder="Cuéntanos cómo podemos ayudarte..."
                  class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 dark:border-gray-600 
                         bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                         focus:border-amber-500 dark:focus:border-amber-400 focus:ring-2 
                         focus:ring-amber-200 dark:focus:ring-amber-900/50 outline-none 
                         transition-all resize-none"
                ></textarea>
              </div>

              <!-- Botones -->
              <div class="flex gap-4">
                <button 
                  type="button" 
                  @click="limpiarFormulario"
                  class="flex-1 px-6 py-3 rounded-lg border-2 border-gray-300 dark:border-gray-600 
                         text-gray-700 dark:text-gray-300 font-semibold
                         hover:bg-gray-100 dark:hover:bg-gray-600 transition-all"
                >
                  Limpiar
                </button>
                <button 
                  type="submit"
                  :disabled="enviando"
                  class="flex-1 px-6 py-3 rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 
                         hover:from-amber-600 hover:to-amber-700 text-white font-semibold
                         shadow-lg hover:shadow-xl transition-all duration-300 
                         disabled:opacity-50 disabled:cursor-not-allowed
                         transform hover:scale-105 disabled:hover:scale-100"
                >
                  {{ enviando ? 'Enviando...' : 'Enviar Mensaje' }}
                </button>
              </div>

              <!-- Mensaje de respuesta -->
              <Transition
                enter-active-class="transition-all duration-300"
                leave-active-class="transition-all duration-200"
                enter-from-class="opacity-0 -translate-y-2"
                enter-to-class="opacity-100 translate-y-0"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-2"
              >
                <div
                  v-if="mensaje.text"
                  :class="[
                    'p-4 rounded-lg border-2 flex items-start gap-3',
                    mensaje.tipo === 'success' 
                      ? 'bg-green-50 dark:bg-green-900/20 border-green-300 dark:border-green-700' 
                      : 'bg-red-50 dark:bg-red-900/20 border-red-300 dark:border-red-700'
                  ]"
                >
                  <svg 
                    v-if="mensaje.tipo === 'success'"
                    xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 20 20" 
                    fill="currentColor" 
                    class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5"
                  >
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                  </svg>
                  <svg
                    v-else
                    xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 20 20" 
                    fill="currentColor" 
                    class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5"
                  >
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                  </svg>
                  <p 
                    :class="mensaje.tipo === 'success' 
                      ? 'text-green-800 dark:text-green-300' 
                      : 'text-red-800 dark:text-red-300'"
                  >
                    {{ mensaje.text }}
                  </p>
                </div>
              </Transition>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue';
import axios from 'axios';
import { MapPin, Phone, Mail, Clock, MessageCircle } from 'lucide-vue-next';

const enviando = ref(false);

const contactos = [
  { 
    title: 'Ubicación', 
    icon: MapPin, 
    info: '<p>Av. Principal 123, Miraflores</p><p>Lima, Perú 15074</p>',
    action: {
      text: 'Ver en mapa',
      link: 'https://maps.google.com'
    }
  },
  { 
    title: 'Reservas', 
    icon: Phone, 
    info: '<p><a href="tel:+51123456789" class="hover:text-amber-600 dark:hover:text-amber-400 transition">+51 1 234 5678</a></p><p><a href="tel:+51987654321" class="hover:text-amber-600 dark:hover:text-amber-400 transition">+51 987 654 321</a></p>',
    action: {
      text: 'Llamar ahora',
      link: 'tel:+51123456789'
    }
  },
  { 
    title: 'Correo Electrónico', 
    icon: Mail, 
    info: '<p><a href="mailto:reservas@hotelnuevo.com" class="hover:text-amber-600 dark:hover:text-amber-400 transition">reservas@hotelnuevo.com</a></p><p><a href="mailto:info@hotelnuevo.com" class="hover:text-amber-600 dark:hover:text-amber-400 transition">info@hotelnuevo.com</a></p>',
    action: {
      text: 'Enviar email',
      link: 'mailto:reservas@hotelnuevo.com'
    }
  },
  { 
    title: 'WhatsApp', 
    icon: MessageCircle, 
    info: '<p>Atención inmediata por WhatsApp</p><p>+51 987 654 321</p>',
    action: {
      text: 'Chatear ahora',
      link: 'https://wa.me/51987654321'
    }
  },
];

const mensaje = reactive({
  text: '',
  tipo: ''
});

const form = reactive({
  first_name: '',
  email: '',
  phone: '',
  asunto: '',
  subject: ''
});

const limpiarFormulario = () => {
  form.first_name = '';
  form.email = '';
  form.phone = '';
  form.asunto = '';
  form.subject = '';
};

const enviarFormulario = async () => {
  enviando.value = true;
  
  try {
    await axios.post('/contacto-hotel', form);
    mensaje.text = '✅ ¡Mensaje enviado exitosamente! Nos pondremos en contacto contigo pronto.';
    mensaje.tipo = 'success';
    limpiarFormulario();
  } catch (error) {
    console.error(error);
    mensaje.text = '❌ Error al enviar el mensaje. Por favor, intenta nuevamente o contáctanos por teléfono.';
    mensaje.tipo = 'error';
  } finally {
    enviando.value = false;
  }

  setTimeout(() => {
    mensaje.text = '';
    mensaje.tipo = '';
  }, 5000);
};
</script>