<script setup lang="ts">
import { ref, watch } from 'vue'
import Dialog from 'primevue/dialog'
import InputText from 'primevue/inputtext'
import InputNumber from 'primevue/inputnumber'
import Button from 'primevue/button'
import Dropdown from 'primevue/dropdown'
import Tag from 'primevue/tag'
import axios from 'axios'
import { useToast } from 'primevue/usetoast'

interface Habitacion {
    number: string
    floor_id: number | null
    room_type_id: number | null
    price: number | null
    characteristics: string
    state: string
}

interface Floor {
    id: number
    name: string
}

interface RoomType {
    id: number
    name: string
}

interface ServerErrors {
    [key: string]: string[]
}

const props = defineProps<{
    visible: boolean
    habitacionId: number | null
}>()

const emit = defineEmits<{
    (e: 'update:visible', value: boolean): void
    (e: 'updated'): void
}>()

const toast = useToast()
const dialogVisible = ref<boolean>(props.visible)
const loading = ref(false)
const submitted = ref(false)
const serverErrors = ref<ServerErrors>({})

const habitacion = ref<Habitacion>({
    number: '',
    floor_id: null,
    room_type_id: null,
    price: null,
    characteristics: '',
    state: 'libre'
})

const floors = ref<Floor[]>([])
const roomTypes = ref<RoomType[]>([])

const estados = [
    { name: 'Libre', value: 'libre' },
    { name: 'Ocupada', value: 'ocupada' },
    { name: 'Limpieza', value: 'limpieza' },
    { name: 'Mantenimiento', value: 'mantenimiento' },
    { name: 'Reservado', value: 'reservado' }
]

watch(() => props.visible, (val) => {
    dialogVisible.value = val
    if (val && props.habitacionId) {
        fetchHabitacion()
        fetchCatalogos()
    }
})

watch(dialogVisible, val => emit('update:visible', val))

const fetchHabitacion = async () => {
    try {
        loading.value = true
        const res = await axios.get(`/habitacion/${props.habitacionId}`)
        const data = res.data.room

        habitacion.value = {
            number: data.number,
            floor_id: data.floor_id,
            room_type_id: data.room_type_id,
            price: data.price,
            characteristics: data.characteristics ?? '',
            state: data.state
        }

    } catch (e) {
        console.error(e);
        toast.add({ severity:'error', summary:'Error', detail:'No se pudo cargar la habitación', life:3000 })
    } finally {
        loading.value = false
    }
}

const fetchCatalogos = async () => {
    try {
        const [floorsRes, typesRes] = await Promise.all([
            axios.get('/piso', { params:{ state:1 } }),
            axios.get('/tipo-habitacion', { params:{ state:1 } })
        ])

        floors.value = floorsRes.data.data
        roomTypes.value = typesRes.data.data

    } catch {
        toast.add({ severity:'error', summary:'Error', detail:'No se pudieron cargar los catálogos', life:3000 })
    }
}

const updateHabitacion = async () => {
    submitted.value = true
    serverErrors.value = {}

    if (
        !habitacion.value.number ||
        !habitacion.value.floor_id ||
        !habitacion.value.room_type_id ||
        !habitacion.value.price ||
        !habitacion.value.state
    ){
        toast.add({ severity:'error', summary:'Error', detail:'Complete los campos obligatorios', life:3000 })
        return
    }

    try {
        await axios.put(`/habitacion/${props.habitacionId}`, habitacion.value)

        toast.add({
            severity:'success',
            summary:'Actualizado',
            detail:'Habitación actualizada correctamente',
            life:3000
        })

        dialogVisible.value = false
        emit('updated')

    } catch (error:any) {

        if (error.response?.data?.errors) {
            serverErrors.value = error.response.data.errors
            toast.add({
                severity:'error',
                summary:'Error de validación',
                detail:'Revisa los campos',
                life:4000
            })
        } else {
            toast.add({
                severity:'error',
                summary:'Error',
                detail:'No se pudo actualizar la habitación',
                life:3000
            })
        }
    }
}

const getSeverity = (state:string) => {
    switch(state){
        case 'libre': return 'success'
        case 'ocupada': return 'danger'
        case 'limpieza': return 'warning'
        case 'mantenimiento': return 'info'
        case 'reservado': return 'secondary'
    }
}
</script>

<template>
<Dialog
    v-model:visible="dialogVisible"
    header="Editar Habitación"
    modal
    :style="{ width:'85vw', maxWidth:'550px' }"
>

<div class="flex flex-col gap-5">

<div>
<label class="font-bold">Número *</label>
<InputText v-model="habitacion.number" class="w-full" />
<small v-if="serverErrors.number" class="text-red-500">{{ serverErrors.number[0] }}</small>
</div>

<div>
<label class="font-bold">Piso *</label>
<Dropdown
    v-model="habitacion.floor_id"
    :options="floors"
    optionLabel="name"
    optionValue="id"
    placeholder="Seleccione piso"
    class="w-full"
/>
</div>

<div>
<label class="font-bold">Tipo Habitación *</label>
<Dropdown
    v-model="habitacion.room_type_id"
    :options="roomTypes"
    optionLabel="name"
    optionValue="id"
    placeholder="Seleccione tipo"
    class="w-full"
/>
</div>

<div>
<label class="font-bold">Precio *</label>
<InputNumber v-model="habitacion.price" mode="decimal" class="w-full" />
</div>

<div>
<label class="font-bold">Características</label>
<InputText v-model="habitacion.characteristics" class="w-full" />
</div>

<div>
<label class="font-bold">Estado *</label>
<Dropdown
    v-model="habitacion.state"
    :options="estados"
    optionLabel="name"
    optionValue="value"
    class="w-full"
/>
<div class="mt-2">
<Tag :value="habitacion.state" :severity="getSeverity(habitacion.state)" />
</div>
</div>

</div>

<template #footer>
<Button label="Cancelar" text icon="pi pi-times" @click="dialogVisible=false" />
<Button label="Guardar" icon="pi pi-check" :loading="loading" @click="updateHabitacion" />
</template>

</Dialog>
</template>
