<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';
import Button from 'primevue/button';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputText from 'primevue/inputtext';
import Tag from 'primevue/tag';
import Select from 'primevue/select';
import axios from 'axios';
import { debounce } from 'lodash';
import DeleteTipoHabitacion from './DeleteTipoHabitacion.vue';
import UpdateTipoHabitacion from './UpdateTipoHabitacion.vue';
import { useToast } from 'primevue/usetoast';

// Interfaces
interface TipoHabitacion {
  id: number;
  name: string;
  description: string;
  state: boolean;
  creacion?: string;
  actualizacion?: string;
}

interface EstadoOption {
  name: string;
  value: string | number;
}

// Refs
const dt = ref<any>(null);
const tipoHabitaciones = ref<TipoHabitacion[]>([]);
const selectedTipoHabitaciones = ref<TipoHabitacion[] | null>(null);
const loading = ref(false);
const globalFilterValue = ref('');
const deleteTipoHabitacionDialog = ref(false);
const updateTipoHabitacionDialog = ref(false);
const tipoHabitacion = ref<TipoHabitacion | null>(null);
const selectedTipoHabitacionId = ref<number | null>(null);
const selectedEstadoTipoHabitacion = ref<EstadoOption | null>(null);
const currentPage = ref(1);

// Props
const props = defineProps<{ refresh: number }>();

// Toast
const toast = useToast();

// Watchers
watch(() => props.refresh, () => loadTipoHabitacion());

watch(() => selectedEstadoTipoHabitacion.value, () => {
  currentPage.value = 1;
  loadTipoHabitacion();
});

// Funciones
function editTipoHabitacion(e: TipoHabitacion) {
  selectedTipoHabitacionId.value = e.id ?? null;
  updateTipoHabitacionDialog.value = true;
}

const estadoTipoHabitacionOptions = ref<EstadoOption[]>([
  { name: 'TODOS', value: '' },
  { name: 'ACTIVOS', value: 1 },
  { name: 'INACTIVOS', value: 0 },
]);

function handleTipoHabitacionUpdated() {
  loadTipoHabitacion();
}

function confirmDeleteTipoHabitacion(selected: TipoHabitacion) {
  if (selected.id === undefined) return; // evita pasar objeto incompleto
  tipoHabitacion.value = selected;
  deleteTipoHabitacionDialog.value = true;
}

const pagination = ref({ currentPage: 1, perPage: 15, total: 0 });
const filters = ref({ state: null as string | number | null, online: null });

function handleTipoHabitacionDeleted() {
  loadTipoHabitacion();
}

const loadTipoHabitacion = async () => {
  loading.value = true;
  try {
    const params: any = {
      page: pagination.value.currentPage,
      per_page: pagination.value.perPage,
      search: globalFilterValue.value,
      state: filters.value.state,
    };

    if (selectedEstadoTipoHabitacion.value !== null && selectedEstadoTipoHabitacion.value.value !== '') {
      params.state = selectedEstadoTipoHabitacion.value.value;
    }

    const response = await axios.get('/tipo-habitacion', { params });

    tipoHabitaciones.value = response.data.data;
    pagination.value.currentPage = response.data.meta.current_page;
    pagination.value.total = response.data.meta.total;
  } catch (error) {
    console.error('Error al cargar los Tipos de habitaciones:', error);
    toast.add({ severity: 'error', summary: 'Error', detail: 'No se pudieron cargar los Tipos de habitaciones', life: 3000 });
  } finally {
    loading.value = false;
  }
};

const onPage = (event: { page: number; rows: number }) => {
  pagination.value.currentPage = event.page + 1;
  pagination.value.perPage = event.rows;
  loadTipoHabitacion();
};

const getSeverity = (value: boolean) => (value ? 'success' : 'danger');

const onGlobalSearch = debounce(() => {
  pagination.value.currentPage = 1;
  loadTipoHabitacion();
}, 500);

onMounted(() => {
  loadTipoHabitacion();
});
</script>

<template>
<DataTable 
  ref="dt" 
  v-model:selection="selectedTipoHabitaciones" 
  :value="tipoHabitaciones" 
  dataKey="id" 
  :paginator="true"
  :rows="pagination.perPage" 
  :totalRecords="pagination.total" 
  :loading="loading" 
  :lazy="true" 
  @page="onPage"
  :rowsPerPageOptions="[15, 20, 25]" 
  scrollable 
  scrollDirection="both" 
  responsiveLayout="scroll" 
  class="w-full text-sm sm:text-base"
  paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
  currentPageReportTemplate="Mostrando {first} a {last} de {totalRecords} Tipos de habitaciones"
>
  <template #header>
    <div class="flex flex-col md:flex-row gap-2 items-start md:items-center justify-between w-full">
      <h4 class="m-0 text-base sm:text-lg md:text-xl">TIPOS DE HABITACION</h4>
      <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
        <IconField class="w-full sm:w-64">
          <InputIcon>
            <i class="pi pi-search" />
          </InputIcon>
          <InputText 
            v-model="globalFilterValue" 
            @input="onGlobalSearch" 
            placeholder="Buscar Tipo de habitacion..." 
            class="w-full" 
          />
        </IconField>
        <Select 
          v-model="selectedEstadoTipoHabitacion" 
          :options="estadoTipoHabitacionOptions" 
          optionLabel="name"
          placeholder="Estado" 
          class="w-full sm:w-40" 
        />
        <Button 
          title="Refrescar" 
          icon="pi pi-refresh" 
          outlined 
          rounded 
          aria-label="Refresh" 
          class="w-full sm:w-auto" 
          @click="loadTipoHabitacion" 
        />
      </div>
    </div>
  </template>

  <Column selectionMode="multiple" style="width: 1rem" :exportable="false" />
  <Column field="name" header="Nombre" sortable style="min-width: 12rem" />
  <Column field="description" header="Descripción" sortable style="min-width: 15rem" />
  <Column field="creacion" header="Creación" sortable style="min-width: 13rem" />
  <Column field="actualizacion" header="Actualización" sortable style="min-width: 13rem" />
  <Column field="state" header="Estado" sortable style="min-width: 6rem">
    <template #body="{ data }">
      <Tag :value="data.state ? 'Activo' : 'Inactivo'" :severity="getSeverity(data.state)" />
    </template>
  </Column>
  <Column field="actions" header="Acciones" :exportable="false" style="min-width: 8rem">
    <template #body="slotProps">
      <Button title="Editar Tipo de habitacion" icon="pi pi-pencil" outlined rounded class="mr-2" @click="editTipoHabitacion(slotProps.data)" />
      <Button title="Eliminar Tipode habitacion" icon="pi pi-trash" outlined rounded severity="danger"
        @click="confirmDeleteTipoHabitacion(slotProps.data)" 
      />
    </template>
  </Column>
</DataTable>

<DeleteTipoHabitacion 
  v-model:visible="deleteTipoHabitacionDialog" 
  :tipoHabitacion="tipoHabitacion" 
  @deleted="handleTipoHabitacionDeleted" 
/>
<UpdateTipoHabitacion 
  v-model:visible="updateTipoHabitacionDialog" 
  :tipoHabitacionId="selectedTipoHabitacionId"
  @updated="handleTipoHabitacionUpdated" 
/>
</template>
