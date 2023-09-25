<script setup>
import Breadcrumb from '@/Components/Breadcrumb.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ChevronRightIcon, KeyIcon, ShieldCheckIcon, UserIcon } from '@heroicons/vue/24/solid';
import { Head, Link } from '@inertiajs/vue3';
import { watchEffect } from 'vue';


const props = defineProps({
    users: Number,
    roles: Number,
    reportes: Number,
    permissions: Number,
})

const dashboard =[
    'users',
    'reportes',
    // 'roles',
];
const dashSinS = dashboard.map((value, index, array) => {
    return value.slice(0,-1)
})
const colores =[
    'bg-blue-500',
    'bg-green-500',
    // 'bg-blue-500',
];
const laImg =[ //todo:
    'KeyIcon',
    'KeyIcon',
    // 'KeyIcon',
];

</script>

<template>

    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <Breadcrumb :title="'Resumen'" :breadcrumbs="[]" />
        <div class="space-y-4">
            <div
                class="text-white dark:text-gray-100 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-2 sm:gap-4 overflow-hidden shadow-sm">
                <div v-for="(modelo, index) in dashboard" :key="index">
                    <div
                        class="rounded-t-none sm:rounded-t-lg px-4 py-6 flex justify-between items-center overflow-hidden"
                        :class="colores[index]">
                        <div class="flex flex-col">
                            <p class="text-4xl font-bold">{{ props[modelo] }}</p>
                            <p class="text-md md:text-lg uppercase">{{ lang().label[modelo] }}</p>
                        </div>
                        <!-- <div>
                            <KeyIcon class="w-16 h-auto" />
                        </div> -->
                    </div>
                    <div
                        class="rounded-b-none sm:rounded-b-lg p-2 overflow-hidden hover:bg-sky-600 dark:hover:bg-black"
                        :class="colores[index]"
                        >
                        <Link :href="route(dashSinS[index]+'.index')" class="flex justify-between items-center">
                            <p>{{ lang().label.more }}</p>
                            <ChevronRightIcon class="w-5 h-5" />
                        </Link>
                    </div>
                </div>
                <!-- <div>
                    <div
                        class="rounded-t-none sm:rounded-t-lg px-4 py-6 flex justify-between bg-green-600/70 dark:bg-green-500/80 items-center overflow-hidden">
                        <div class="flex flex-col">
                            <p class="text-4xl font-bold">{{ props.roles }}</p>
                            <p class="text-md md:text-lg uppercase">{{ lang().label.role }}</p>
                        </div>
                        <div>
                            <KeyIcon class="w-16 h-auto" />
                        </div>
                    </div>
                    <div
                        class="bg-green-600 dark:bg-green-600/80 rounded-b-none sm:rounded-b-lg p-2 overflow-hidden hover:bg-green-600/90 dark:hover:bg-green-600/70">
                        <Link :href="route('role.index')" class="flex justify-between items-center">
                        <p>{{ lang().label.more }}</p>
                        <ChevronRightIcon class="w-5 h-5" />
                        </Link>
                    </div>
                </div> -->


                <div v-if="can(['isSuper'])">
                    <div
                        class="rounded-t-none sm:rounded-t-lg px-4 py-6 flex justify-between bg-amber-600/70 dark:bg-amber-500/80 items-center overflow-hidden">
                        <div class="flex flex-col">
                            <p class="text-4xl font-bold">{{ props.permissions }}</p>
                            <p class="text-md md:text-lg uppercase">{{ lang().label.permission }}</p>
                        </div>
                        <!-- <div>
                            <ShieldCheckIcon class="w-16 h-auto" />
                        </div> -->
                    </div>
                    <div
                        class="bg-amber-600 dark:bg-amber-600/80 rounded-b-none sm:rounded-b-lg p-2 overflow-hidden hover:bg-amber-600/90 dark:hover:bg-amber-600/70">
                        <Link :href="route('permission.index')" class="flex justify-between items-center">
                        <p>{{ lang().label.more }}</p>
                        <ChevronRightIcon class="w-5 h-5" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
