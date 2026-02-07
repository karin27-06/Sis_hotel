<template>
  <section
    id="faqs"
    class="py-20 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800"
  >
    <div class="mx-auto max-w-[1200px] px-6">
      <!-- Header -->
      <div class="mb-16 text-center">
        <span class="inline-block mb-4 text-amber-600 dark:text-amber-400 font-semibold text-sm tracking-wider uppercase">
          FAQs
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
          Preguntas Frecuentes
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
          Encuentra respuestas a las preguntas más comunes sobre tu estadía
        </p>
      </div>

      <!-- Acordeón de preguntas -->
      <div class="space-y-4 max-w-4xl mx-auto">
        <div
          v-for="(faq, index) in faqs"
          :key="index"
          class="group overflow-hidden rounded-2xl bg-white dark:bg-gray-800 
                 border-2 transition-all duration-300"
          :class="openIndex === index 
            ? 'border-amber-400 dark:border-amber-500 shadow-lg' 
            : 'border-gray-200 dark:border-gray-700 shadow hover:shadow-md'"
        >
          <!-- Pregunta -->
          <button
            @click="toggle(index)"
            class="w-full text-left px-6 py-5 font-semibold flex justify-between items-center 
                   text-gray-900 dark:text-white hover:text-amber-600 dark:hover:text-amber-400 
                   transition-colors"
          >
            <span class="flex items-center gap-3 text-base md:text-lg">
              <component 
                :is="faq.icon" 
                class="w-5 h-5 flex-shrink-0 text-amber-500"
              />
              {{ faq.question }}
            </span>
            <div 
              class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center 
                     bg-gray-100 dark:bg-gray-700 group-hover:bg-amber-100 
                     dark:group-hover:bg-amber-900/30 transition-all duration-300"
              :class="openIndex === index ? 'rotate-180' : ''"
            >
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" 
                   class="w-5 h-5 text-amber-600 dark:text-amber-400 transition-transform duration-300">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
              </svg>
            </div>
          </button>

          <!-- Respuesta -->
          <Transition
            enter-active-class="transition-all duration-300 ease-out"
            leave-active-class="transition-all duration-200 ease-in"
            enter-from-class="opacity-0 max-h-0"
            enter-to-class="opacity-100 max-h-96"
            leave-from-class="opacity-100 max-h-96"
            leave-to-class="opacity-0 max-h-0"
          >
            <div
              v-show="openIndex === index"
              class="overflow-hidden"
            >
              <div class="px-6 pb-5 text-gray-600 dark:text-gray-300 border-t border-gray-200 dark:border-gray-700 pt-4">
                <p class="leading-relaxed">{{ faq.answer }}</p>
                <div v-if="faq.extra" class="mt-3 p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg border border-amber-200 dark:border-amber-800">
                  <p class="text-sm text-amber-800 dark:text-amber-300">
                    <strong>💡 Tip:</strong> {{ faq.extra }}
                  </p>
                </div>
              </div>
            </div>
          </Transition>
        </div>
      </div>

      <!-- CTA para más ayuda -->
      <div class="mt-16 text-center">
        <div class="inline-flex flex-col items-center gap-4 p-8 bg-gradient-to-br from-amber-50 to-amber-100 
                    dark:from-gray-800 dark:to-gray-700 rounded-2xl border-2 border-amber-200 
                    dark:border-gray-600">
          <div class="w-16 h-16 rounded-full bg-amber-500 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8 text-white">
              <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd" />
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
              ¿Aún tienes dudas?
            </h3>
            <p class="text-gray-600 dark:text-gray-300 mb-4">
              Nuestro equipo está disponible 24/7 para ayudarte
            </p>
            <a 
              href="#contacto" 
              class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 
                     hover:from-amber-600 hover:to-amber-700 text-white px-8 py-3 rounded-full 
                     shadow-lg hover:shadow-xl transition-all duration-300 font-semibold
                     transform hover:scale-105"
            >
              <span>Contáctanos</span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Clock, CreditCard, MapPin, Calendar, Wifi, Coffee, ParkingCircle, User } from 'lucide-vue-next';

const faqs = ref([
  {
    icon: Clock,
    question: '¿Cuáles son los horarios de check-in y check-out?',
    answer: 'El check-in está disponible a partir de las 3:00 PM y el check-out debe realizarse antes de las 12:00 PM (mediodía). Ofrecemos check-in anticipado y late check-out sujeto a disponibilidad y puede aplicar un cargo adicional.',
    extra: 'Contáctanos con anticipación si necesitas horarios especiales, haremos nuestro mejor esfuerzo para acomodarte.'
  },
  {
    icon: CreditCard,
    question: '¿Qué formas de pago aceptan?',
    answer: 'Aceptamos todas las principales tarjetas de crédito (Visa, Mastercard, American Express), tarjetas de débito, transferencias bancarias y pagos en efectivo. También aceptamos pagos a través de plataformas digitales como PayPal y Apple Pay.',
    extra: 'Para reservas corporativas, ofrecemos facturación directa con términos especiales.'
  },
  {
    icon: MapPin,
    question: '¿El hotel ofrece servicio de traslado desde/hacia el aeropuerto?',
    answer: 'Sí, ofrecemos servicio de traslado privado desde y hacia el aeropuerto las 24 horas. El servicio debe reservarse con al menos 24 horas de anticipación. El costo varía según la distancia y tipo de vehículo (sedan, SUV, van).',
    extra: 'El traslado incluye asistencia con equipaje y bebidas de cortesía.'
  },
  {
    icon: Calendar,
    question: '¿Cuál es la política de cancelación?',
    answer: 'Ofrecemos cancelación gratuita hasta 48 horas antes de la fecha de llegada. Las cancelaciones realizadas con menos de 48 horas de anticipación están sujetas a un cargo equivalente a una noche de alojamiento. Las tarifas no reembolsables no permiten cancelaciones.',
    extra: 'Para grupos y eventos especiales, las políticas pueden variar.'
  },
  {
    icon: Wifi,
    question: '¿El WiFi está incluido?',
    answer: 'Sí, ofrecemos WiFi de alta velocidad completamente gratuito en todas las áreas del hotel, incluyendo habitaciones, lobby, restaurante, piscina y áreas comunes. También contamos con WiFi premium de mayor velocidad disponible bajo solicitud.',
  },
  {
    icon: Coffee,
    question: '¿El desayuno está incluido en la tarifa?',
    answer: 'Depende de la tarifa seleccionada. Algunas de nuestras habitaciones incluyen desayuno buffet completo. Si tu tarifa no lo incluye, puedes agregarlo por $25 por persona. Nuestro buffet ofrece una amplia variedad de opciones internacionales y locales.',
    extra: 'Niños menores de 6 años desayunan gratis acompañados de un adulto.'
  },
  {
    icon: ParkingCircle,
    question: '¿Tienen estacionamiento disponible?',
    answer: 'Sí, contamos con estacionamiento privado gratuito con servicio de valet parking. El estacionamiento está vigilado las 24 horas y cuenta con espacios cubiertos y descubiertos. También disponemos de estaciones de carga para vehículos eléctricos.',
  },
  {
    icon: User,
    question: '¿Aceptan mascotas?',
    answer: 'Sí, somos un hotel pet-friendly. Aceptamos mascotas de hasta 15 kg con un cargo adicional de $30 por noche. Proporcionamos camas para mascotas, bowls de agua/comida y tenemos áreas designadas para paseos. Por favor, avísanos al momento de la reserva.',
    extra: 'Las mascotas deben estar al día con sus vacunas y ser sociables.'
  },
]);

const openIndex = ref<number | null>(null);

const toggle = (i: number) => {
  openIndex.value = openIndex.value === i ? null : i;
};
</script>