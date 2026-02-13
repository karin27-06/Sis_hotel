<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'
import Button from 'primevue/button'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import IconField from 'primevue/iconfield'
import InputIcon from 'primevue/inputicon'
import InputText from 'primevue/inputtext'
import Tag from 'primevue/tag'
import axios from 'axios'
import { debounce } from 'lodash'
import DeleteHabitacion from './DeleteHabitacion.vue'
import Select from 'primevue/select'
import { useToast } from 'primevue/usetoast'
import UpdateHabitacion from './UpdateHabitacion.vue'

interface Habitacion {
    id: number
    number: string
    floor?: string
    room_type?: string
    price: number
    characteristics?: string
    state: string
    creacion?: string
    actualizacion?: string
}

interface Pagination {
    currentPage: number
    perPage: number
    total: number
}

interface EstadoOption {
    name: string
    value: string | null
}

const dt = ref()
const habitaciones = ref<Habitacion[]>([])
const selectedHabitaciones = ref<Habitacion[] | null>(null)
const loading = ref(false)
const globalFilterValue = ref('')
const deleteDialog = ref(false)
const habitacion = ref<Habitacion | null>(null)
const selectedHabitacionId = ref<number | null>(null)
const selectedEstado = ref<EstadoOption | null>(null)
const updateDialog = ref(false)

const toast = useToast()

const props = defineProps<{ refresh: number }>()

watch(() => props.refresh, () => {
    loadHabitaciones();
});
watch(() => selectedEstado.value, () => {
    pagination.value.currentPage = 1
    loadHabitaciones()
})

function editHabitacion(h: Habitacion) {
    selectedHabitacionId.value = h.id
    updateDialog.value = true
}

function confirmDelete(h: Habitacion) {
    habitacion.value = h
    deleteDialog.value = true
}

function handleDeleted() {
    loadHabitaciones()
}

function handleUpdated() {
    loadHabitaciones()
}

const estadoOptions = ref<EstadoOption[]>([
    { name: 'TODOS', value: null },
    { name: 'LIBRE', value: 'libre' },
    { name: 'OCUPADA', value: 'ocupada' },
    { name: 'LIMPIEZA', value: 'limpieza' },
    { name: 'MANTENIMIENTO', value: 'mantenimiento' },
    { name: 'RESERVADO', value: 'reservado' }
])

const pagination = ref<Pagination>({
    currentPage: 1,
    perPage: 15,
    total: 0
})

const loadHabitaciones = async () => {
    loading.value = true
    try {
        const params: Record<string, any> = {
            page: pagination.value.currentPage,
            per_page: pagination.value.perPage,
            search: globalFilterValue.value
        }

        if (selectedEstado.value?.value) {
            params.state = selectedEstado.value.value
        }

        const res = await axios.get('/habitacion', { params })

        habitaciones.value = res.data.data
        pagination.value.currentPage = res.data.meta.current_page
        pagination.value.total = res.data.meta.total

    } catch (error) {
        console.error(error)
        toast.add({
            severity: 'error',
            summary: 'Error',
            detail: 'No se pudieron cargar las habitaciones',
            life: 3000
        })
    } finally {
        loading.value = false
    }
}

const onPage = (event: any) => {
    pagination.value.currentPage = event.page + 1
    pagination.value.perPage = event.rows
    loadHabitaciones()
}

const onGlobalSearch = debounce(() => {
    pagination.value.currentPage = 1
    loadHabitaciones()
}, 500)

const getSeverity = (state: string) => {
    switch (state) {
        case 'libre': return 'success'
        case 'ocupada': return 'danger'
        case 'limpieza': return 'warning'
        case 'mantenimiento': return 'info'
        case 'reservado': return 'secondary'
        default: return undefined
    }
}

onMounted(loadHabitaciones)
</script>

<template>
<DataTable
    ref="dt"
    v-model:selection="selectedHabitaciones"
    :value="habitaciones"
    dataKey="id"
    paginator
    :rows="pagination.perPage"
    :totalRecords="pagination.total"
    :loading="loading"
    lazy
    @page="onPage"
    :rowsPerPageOptions="[15,20,25]"
    scrollable
    scrollHeight="574px"
    currentPageReportTemplate="Mostrando {first} a {last} de {totalRecords} habitaciones"
>

<template #header>
<div class="flex flex-col sm:flex-row gap-3 justify-between">
    <h4>HABITACIONES</h4>

    <div class="flex gap-2">
        <IconField>
            <InputIcon><i class="pi pi-search" /></InputIcon>
            <InputText
                v-model="globalFilterValue"
                @input="onGlobalSearch"
                placeholder="Buscar habitación..."
            />
        </IconField>

        <Select
            v-model="selectedEstado"
            :options="estadoOptions"
            optionLabel="name"
            placeholder="Estado"
        />

        <Button icon="pi pi-refresh" outlined rounded @click="loadHabitaciones" />
    </div>
</div>
</template>

<Column selectionMode="multiple" style="width:1rem"/>

<Column field="number" header="Número" sortable />
<Column field="floor" header="Piso" sortable />
<Column field="room_type" header="Tipo" sortable />
<Column field="price" header="Precio" sortable />
<Column field="characteristics" header="Características" />
<Column field="creacion" header="Creación" sortable />
<Column field="actualizacion" header="Actualización" sortable />

<Column field="state" header="Estado">
<template #body="{ data }">
<Tag :value="data.state" :severity="getSeverity(data.state)" />
</template>
</Column>

<Column header="Acciones">
<template #body="{ data }">
<div class="flex gap-2">
<Button icon="pi pi-pencil" outlined rounded @click="editHabitacion(data)" />
<Button icon="pi pi-trash" outlined rounded severity="danger" @click="confirmDelete(data)" />
</div>
</template>
</Column>

</DataTable>

<DeleteHabitacion
    v-model:visible="deleteDialog"
    :habitacion="habitacion"
    @deleted="handleDeleted"
/>

<UpdateHabitacion
    v-model:visible="updateDialog"
    :habitacionId="selectedHabitacionId"
    @updated="handleUpdated"
/>
</template>
