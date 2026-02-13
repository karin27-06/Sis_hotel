<script setup lang="ts">
import { ref, watch } from 'vue'
import axios from 'axios'
import Dialog from 'primevue/dialog'
import Button from 'primevue/button'
import { useToast } from 'primevue/usetoast'

interface Habitacion {
    id: number
    number: string
    [key: string]: any
}

const props = defineProps<{
    visible: boolean
    habitacion: Habitacion | null
}>()

const emit = defineEmits<{
    (e: 'update:visible', value: boolean): void
    (e: 'deleted'): void
}>()

const toast = useToast()
const localVisible = ref<boolean>(false)

watch(() => props.visible, (newVal) => {
    localVisible.value = newVal
})

function closeDialog(): void {
    emit('update:visible', false)
}

async function deleteHabitacion(): Promise<void> {
    if (!props.habitacion) return

    try {
        await axios.delete(`/habitacion/${props.habitacion.id}`)

        emit('deleted')
        closeDialog()

        toast.add({
            severity: 'success',
            summary: 'Éxito',
            detail: 'Habitación eliminada correctamente',
            life: 3000
        })

    } catch (error: any) {
        console.error(error)

        let errorMessage = 'Error eliminando la habitación'

        if (error.response) {
            errorMessage = error.response.data.message || errorMessage
        }

        toast.add({
            severity: 'error',
            summary: 'Error',
            detail: errorMessage,
            life: 3000
        })
    }
}
</script>

<template>
    <Dialog
        v-model:visible="localVisible"
        :style="{ width: '90vw', maxWidth: '450px' }"
        header="Confirmar"
        :modal="true"
        @update:visible="closeDialog"
    >
        <div class="flex items-center gap-4">
            <i class="pi pi-exclamation-triangle !text-3xl" />
            <span v-if="habitacion">
                ¿Estás seguro de eliminar la habitación <b>{{ habitacion.number }}</b>?
            </span>
        </div>

        <template #footer>
            <Button label="No" icon="pi pi-times" text @click="closeDialog" />
            <Button label="Sí" icon="pi pi-check" @click="deleteHabitacion" />
        </template>
    </Dialog>
</template>
