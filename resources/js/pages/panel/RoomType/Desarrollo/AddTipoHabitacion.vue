<script setup lang="ts">
import { ref } from 'vue';
import axios, { AxiosError } from 'axios';
import Dialog from 'primevue/dialog';
import Toolbar from 'primevue/toolbar';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Checkbox from 'primevue/checkbox';
import Tag from 'primevue/tag';
import { useToast } from 'primevue/usetoast';
import ToolsRoomType from './toolsRoomType.vue';

// Interfaces
interface TipoHabitacion {
    name: string;
    description: string;
    state: boolean;
}

interface ServerErrors {
    [key: string]: string[];
}

// Toast
const toast = useToast();

// Refs
const submitted = ref<boolean>(false);
const tipoHabitacionDialog = ref<boolean>(false);
const serverErrors = ref<ServerErrors>({});
const tipoHabitacion = ref<TipoHabitacion>({
    name: '',
    description: '',
    state: true
});

// Emite evento al padre
const emit = defineEmits<{
    (e: 'tipoHabitacion-agregada'): void
}>();

// Métodos
function resetTipoHabitacion() {
    tipoHabitacion.value = {
        name: '',
        description: '',
        state: true
    };
    serverErrors.value = {};
    submitted.value = false;
}

function openNew() {
    resetTipoHabitacion();
    tipoHabitacionDialog.value = true;
}

function hideDialog() {
    tipoHabitacionDialog.value = false;
    resetTipoHabitacion();
}

/*async function loadTipoHabitacion() {
    try {
        const response = await axios.get('/tipo-habitacion');
        console.log(response.data);
        emit('tipoHabitacion-agregada');
    } catch (error) {
        toast.add({ severity: 'error', summary: 'Error', detail: 'No se pudo cargar los Tipos de habitaciones', life: 3000 });
        console.error(error);
    }
}*/

async function guardarTipoHabitacion() {
    submitted.value = true;
    serverErrors.value = {};

    if (!tipoHabitacion.value.name) return;

    try {
        await axios.post('/tipo-habitacion', tipoHabitacion.value);
        toast.add({ severity: 'success', summary: 'Éxito', detail: 'Tipo de habitacion registrado', life: 3000 });
        hideDialog();
        emit('tipoHabitacion-agregada');
    } catch (error) {
        const axiosError = error as AxiosError;
        if (axiosError.response && axiosError.response.status === 422) {
            serverErrors.value = (axiosError.response.data as any).errors || {};
        } else {
            toast.add({
                severity: 'error',
                summary: 'Error',
                detail: 'No se pudo registrar el Tipo de habitacion',
                life: 3000
            });
        }
    }
}
</script>

<template>
<Toolbar class="mb-6">
    <template #start>
        <Button label="Nuevo Tipo de habitacion" icon="pi pi-plus" severity="secondary" class="mr-2" @click="openNew" />
    </template>
    <template #end>
        <ToolsRoomType />       
    </template>
</Toolbar>

<Dialog 
    v-model:visible="tipoHabitacionDialog" 
    :style="{ width: '95vw', maxWidth: '600px' }" 
    header="Registro de tipo de habitaciones" 
    :modal="true"
>
    <div class="flex flex-col gap-6">
        <div class="grid grid-cols-12 gap-4">
            
            <!-- Nombre -->
            <div class="col-span-12 md:col-span-10">
                <label class="block font-bold mb-3">Nombre <span class="text-red-500">*</span></label>
                <InputText
                    v-model.trim="tipoHabitacion.name"
                    required
                    maxlength="150"
                    fluid
                    class="w-full"
                />
                <small v-if="submitted && !tipoHabitacion.name" class="text-red-500">El nombre es obligatorio.</small>
                <small v-if="serverErrors.name" class="text-red-500">{{ serverErrors.name[0] }}</small>
            </div>

            <!-- Estado -->
            <div class="col-span-12 md:col-span-2 flex flex-col">
                <label class="block font-bold mb-2">Estado <span class="text-red-500">*</span></label>
                <div class="flex items-center gap-3">
                    <Checkbox v-model="tipoHabitacion.state" :binary="true" />
                    <Tag :value="tipoHabitacion.state ? 'Activo' : 'Inactivo'" :severity="tipoHabitacion.state ? 'success' : 'danger'" />
                </div>
                <small v-if="serverErrors.state" class="text-red-500">{{ serverErrors.state[0] }}</small>
            </div>

            <!-- Descripción -->
            <div class="col-span-12">
                <label class="block font-bold mb-3">Descripción</label>
                <Textarea 
                    v-model="tipoHabitacion.description" 
                    maxlength="255" 
                    rows="4" 
                    autoResize 
                    fluid
                    class="w-full"
                    :class="{ 'p-invalid': serverErrors.description }" 
                />
                <small v-if="serverErrors.description" class="text-red-500">{{ serverErrors.description[0] }}</small>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <template #footer>
        <div class="flex flex-col sm:flex-row gap-2 w-full sm:justify-end">
            <Button label="Cancelar" icon="pi pi-times" text @click="hideDialog" class="w-full sm:w-auto" />
            <Button label="Guardar" icon="pi pi-check" @click="guardarTipoHabitacion" class="w-full sm:w-auto" />
        </div>
    </template>
</Dialog>
</template>
