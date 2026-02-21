<template>
    <Toolbar class="mb-6">
        <template #start>
            <Button label="Nueva habitación" icon="pi pi-plus" severity="secondary" class="mr-2" @click="openNew" />
        </template>
        <template #end>
            <!-- ToolsCustomer para los botones de exportar e importar -->
            <ToolsCustomer/> 
        </template>
    </Toolbar>

    <Dialog v-model:visible="habitacionDialog" :style="{ width: '85vw', maxWidth: '600px' }" header="Registro de habitación" :modal="true">
        <div class="flex flex-col gap-6">

            <div class="grid grid-cols-12 gap-4">

                <!-- Numero -->
                <div class="col-span-12 md:col-span-6">
                    <label class="block font-bold mb-2">Número <span class="text-red-500">*</span></label>
                    <InputText v-model.trim="habitacion.number" fluid placeholder="Ej: 101" />
                    <small v-if="submitted && !habitacion.number" class="text-red-500">El número es obligatorio.</small>
                    <small v-if="serverErrors.number" class="text-red-500">{{ serverErrors.number[0] }}</small>
                </div>

                <!-- Precio -->
                <div class="col-span-12 md:col-span-6">
                    <label class="block font-bold mb-2">Precio <span class="text-red-500">*</span></label>
                        <InputNumber
                            v-model="habitacion.price"
                            mode="decimal"
                            :min="0"
                            :minFractionDigits="2"
                            :maxFractionDigits="2"
                            fluid
                        />
                    <small v-if="submitted && !habitacion.price" class="text-red-500">El precio es obligatorio.</small>
                    <small v-if="serverErrors.price" class="text-red-500">{{ serverErrors.price[0] }}</small>
                </div>

                <!-- Piso -->
                <div class="col-span-12 md:col-span-6">
                    <label class="block font-bold mb-2">Piso <span class="text-red-500">*</span></label>
                    <Dropdown
                        v-model="habitacion.floor_id"
                        :options="floors"
                        optionLabel="name"
                        optionValue="id"
                        placeholder="Seleccione piso"
                        fluid
                    />
                    <small v-if="submitted && !habitacion.floor_id" class="text-red-500">Debe seleccionar un piso.</small>
                    <small v-if="serverErrors.floor_id" class="text-red-500">{{ serverErrors.floor_id[0] }}</small>
                </div>

                <!-- Tipo habitación -->
                <div class="col-span-12 md:col-span-6">
                    <label class="block font-bold mb-2">Tipo de habitación <span class="text-red-500">*</span></label>
                    <Dropdown
                        v-model="habitacion.room_type_id"
                        :options="roomTypes"
                        optionLabel="name"
                        optionValue="id"
                        placeholder="Seleccione tipo"
                        filter
                        fluid
                    />
                    <small v-if="submitted && !habitacion.room_type_id" class="text-red-500">Debe seleccionar un tipo.</small>
                    <small v-if="serverErrors.room_type_id" class="text-red-500">{{ serverErrors.room_type_id[0] }}</small>
                </div>

                <!-- Caracteristicas -->
                <div class="col-span-12">
                    <label class="block font-bold mb-2">Características</label>
                    <InputText v-model="habitacion.characteristics" fluid placeholder="Opcional" />
                    <small v-if="serverErrors.characteristics" class="text-red-500">{{ serverErrors.characteristics[0] }}</small>
                </div>

            </div>
        </div>

        <template #footer>
            <Button label="Cancelar" icon="pi pi-times" text @click="hideDialog" />
            <Button label="Guardar" icon="pi pi-check" @click="guardarHabitacion" />
        </template>
    </Dialog>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'
import Dialog from 'primevue/dialog'
import Toolbar from 'primevue/toolbar'
import Button from 'primevue/button'
import InputText from 'primevue/inputtext'
import Dropdown from 'primevue/dropdown'
import { useToast } from 'primevue/usetoast'
import InputNumber from 'primevue/inputnumber'

interface Habitacion {
    number: string
    floor_id: number | null
    room_type_id: number | null
    price: number | null
    characteristics: string | null
}

interface ServerErrors {
    [key: string]: string[]
}

const toast = useToast()
const submitted = ref(false)
const habitacionDialog = ref(false)
const serverErrors = ref<ServerErrors>({})
const emit = defineEmits(['habitacion-agregada'])

const habitacion = ref<Habitacion>({
    number: '',
    floor_id: null,
    room_type_id: null,
    price: null,
    characteristics: null
})

const floors = ref([])
const roomTypes = ref([])

function resetHabitacion() {
    habitacion.value = {
        number: '',
        floor_id: null,
        room_type_id: null,
        price: null,
        characteristics: null
    }
    submitted.value = false
    serverErrors.value = {}
}

function openNew() {
    resetHabitacion()
    habitacionDialog.value = true
    fetchFloors()
    fetchRoomTypes()
}

function hideDialog() {
    habitacionDialog.value = false
    resetHabitacion()
}

function fetchFloors() {
    axios.get('/piso', { params: { state: 1 } })
        .then(res => {
        floors.value = res.data.data;
        })
        .catch(() => {
            toast.add({ severity: 'error', summary: 'Error', detail: 'No se pudo cargar los pisos', life: 3000 });
        });
}

function fetchRoomTypes() {
    axios.get('/tipo-habitacion', { params: { state: 1 } })
        .then(res => {roomTypes.value = res.data.data;})
        .catch(() => {
            toast.add({ severity: 'error', summary: 'Error', detail: 'No se pudo cargar los tipos de habitaciones', life: 3000 });
        });
}

function guardarHabitacion() {
    submitted.value = true
    serverErrors.value = {}

    if (!habitacion.value.number ||
        !habitacion.value.floor_id ||
        !habitacion.value.room_type_id ||
        !habitacion.value.price) return

    axios.post('/habitacion', habitacion.value)
        .then(() => {
            toast.add({
                severity: 'success',
                summary: 'Éxito',
                detail: 'Habitación registrada',
                life: 3000
            })
            hideDialog()
            emit('habitacion-agregada')
        })
        .catch(error => {
            if (error.response?.status === 422) {
                serverErrors.value = error.response.data.errors || {}
            } else {
                toast.add({
                    severity: 'error',
                    summary: 'Error',
                    detail: 'No se pudo registrar la habitación',
                    life: 3000
                })
            }
        })
}
</script>
