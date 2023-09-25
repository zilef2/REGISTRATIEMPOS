<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InfoButton from '@/Components/InfoButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { reactive, watch, watchEffect } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';
import pkg from 'lodash';
import Pagination from '@/Components/Pagination.vue';
import { CheckBadgeIcon, ChevronUpDownIcon, PencilIcon, TrashIcon } from '@heroicons/vue/24/solid';
// import Create from '@/Pages/value/Create.vue';
// import Edit from '@/Pages/value/Edit.vue';
// import Delete from '@/Pages/value/Delete.vue';
// import DeleteBulk from '@/Pages/value/DeleteBulk.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { router, usePage, useForm, Link } from '@inertiajs/vue3';

import { IsDate_GOES_formatDate, number_format, formatDate, CalcularEdad, CalcularSexo } from '@/global.ts';

const { _, debounce, pickBy } = pkg
const props = defineProps({
    title: String,
    breadcrumbs: Object,
    numberPermissions: Number,
    cabeza:Object,
    valores:Object,
    total_cantidad:Number,
})
const data = reactive({
    params: {
        // search: props.filters.search,
    },
    // selectedId: [],
})

const order = (field) => { }

// watch(() => _.cloneDeep(data.params), debounce(() => {
//     let params = pickBy(data.params)
//     router.get(route("value.index"), params, {
//         replace: true,
//         preserveState: true,
//         preserveScroll: true,
//     })
// }, 150))

const form = useForm({ })

watchEffect(() => { })

// text // number // dinero // date // datetime // foreign 
const titulos = [
    { order: 'name', label: 'Nombre', type: 'text' },
    { order: 'nacimiento', label: 'Fecha nacimiento', type: 'date' },
];
</script>

<template>
    <Head :title="props.title" />

    <AuthenticatedLayout>
        <Breadcrumb :title="title" :breadcrumbs="breadcrumbs" />
        <div class="space-y-4">
            <div class="px-4 sm:px-0">
                <div class="rounded-lg overflow-hidden w-fit">
                    <PrimaryButton v-show="can(['create value'])" class="rounded-none" @click="data.createOpen = true">
                        {{ lang().button.add }}
                    </PrimaryButton>
                    <!-- <Create :show="data.createOpen" @close="data.createOpen = false" :roles="props.roles"
                        v-if="can(['create value'])" :title="props.title" :titulos="titulos"/>
                    <Edit :show="data.editOpen" @close="data.editOpen = false" :value="data.value" :roles="props.roles"
                        v-if="can(['update value'])" :title="props.title" :titulos="titulos" />
                    <Delete :show="data.deleteOpen" @close="data.deleteOpen = false" :value="data.value"
                        :title="props.title" />
                    <DeleteBulk :show="data.deleteBulkOpen"
                        @close="data.deleteBulkOpen = false, data.multipleSelect = false, data.selectedId = []"
                        :selectedId="data.selectedId" :title="props.title" /> -->
                </div>
            </div>
            <div class="relative bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-between p-2">
                    <div class="flex space-x-2">
                        <!-- <SelectInput v-model="data.params.perPage" :dataSet="data.dataSet" /> -->
                    </div>
                    <!-- <TextInput v-if="props.numberPermissions > 1" v-model="data.params.search" type="text"
                        class="block w-4/6 md:w-3/6 lg:w-2/6 rounded-lg" placeholder="Nombre, correo o identificación" /> -->
                </div>
                <div class="overflow-x-auto scrollbar-table">
                    <table class="w-full">
                        <thead class="uppercase text-sm border-t border-gray-200 dark:border-gray-700">
                            <tr class="dark:bg-gray-900/50 text-left">
                                <th class="px-2 py-4 text-center">#</th>
                                <!-- v-on:click="order('name')" -->
                                <th v-for="(value, index) in cabeza" :key="index" class="px-2 py-4 cursor-pointer" >
                                    <div class="flex justify-between items-center">
                                        <span>{{value}}</span>
                                        <!-- <ChevronUpDownIcon class="w-4 h-4" /> -->
                                    </div>
                                </th>
                                <!-- <th class="px-2 py-4">Accion</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(valuex, index) in valores" :key="index"
                                class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-200/30 hover:dark:bg-gray-900/20">
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center">{{ index++ }}</td>
                                <td v-for="(val, jindex) in valuex" :key="index" class="whitespace-nowrap py-4 px-2 sm:py-3">
                                    <!-- <span v-if="jindex == 7" class="flex justify-start items-center">
                                        {{ IsDate_GOES_formatDate(val) }}
                                    </span> -->
                                    <!-- <span v-else class="flex justify-start items-center"> -->
                                    <span>
                                        {{ (val) }}
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-200/30 hover:dark:bg-gray-900/20">
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center"> </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center"> </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center"> </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center"> </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center">
                                    Total cantidad: {{ props.total_cantidad }}    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="flex justify-between items-center p-2 border-t border-gray-200 dark:border-gray-700">
                    <Pagination :links="props.values" :filters="data.params" />
                </div> -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
