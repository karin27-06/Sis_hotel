<script lang="ts" setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AppMenuItem from './AppMenuItem.vue';

// Tipos para usuario y permisos
interface User {
    permissions?: string[];
}

interface Auth {
    user?: User;
}

// Obtenemos los props de la página
const page = usePage<{ auth: Auth }>();

// Computed para permisos del usuario
const permissions = computed<string[]>(() => page.props.auth.user?.permissions ?? []);

// Función para verificar permisos
const hasPermission = (perm: string): boolean => permissions.value.includes(perm);

// Tipos del menú
interface MenuItem {
    label: string;
    icon?: string;
    to?: string;
    items?: MenuItem[];
}

// Computed para el modelo del menú
const model = computed<MenuItem[]>(() => [
    {
        label: 'Home',
        icon: 'pi pi-fw pi-home',
        items: [
            { label: 'Dashboard', icon: 'pi pi-fw pi-chart-bar', to: '/dashboard' }
        ]
    },
    {
        label: 'Gestión de Habitaciones',
        icon: 'pi pi-building',
        items: [
            hasPermission('ver pisos') && { label: 'Pisos', icon: 'pi pi-fw pi-list', to: '/pisos' },
            hasPermission('ver tipos de habitacion') && { label: 'Tipos de habitacion', icon: 'pi pi-fw pi-briefcase', to: '/tipos-habitacion' },
            hasPermission('ver habitaciones') && { label: 'Habitaciones', icon: 'pi pi-fw pi-briefcase', to: '/habitaciones' },
        ].filter(Boolean) as MenuItem[],
    },
    {
    label: 'Gestion de datos',
    icon: 'pi pi-fw pi-users',
    items: [
        hasPermission('ver clientes') && {
        label: 'Clientes',
        icon: 'pi pi-fw pi-users',
        to: '/clientes'
        },

        // hasPermission('ver tipos_clientes') && {
        //   label: 'Tipo de Clientes',
        //   icon: 'pi pi-fw pi-id-card',
        //   to: '/tipo_clientes'
        // },

    ].filter(Boolean) as MenuItem[],
    },
    {
        label: 'Usuarios y Seguridad',
        icon: 'pi pi-fw pi-lock',
        items: [
            hasPermission('ver usuarios') && { label: 'Gestión de Usuarios', icon: 'pi pi-fw pi-user-edit', to: '/usuario' },
            hasPermission('ver roles') && { label: 'Roles', icon: 'pi pi-fw pi-shield', to: '/roles' },
        ].filter(Boolean) as MenuItem[],
    },
].filter(section => section.items && section.items.length > 0) as MenuItem[]);
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="i">
            <app-menu-item :item="item" :index="i" />
        </template>
    </ul>
</template>

<style scoped lang="scss">
/* Estilos personalizados opcionales */
</style>
