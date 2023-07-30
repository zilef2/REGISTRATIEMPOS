<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { reactive, watch, ref, watchEffect, onMounted } from 'vue';

import DangerButton from '@/Components/DangerButton.vue';
import pkg from 'lodash';
import { router, usePage, Link, useForm } from '@inertiajs/vue3';

import Pagination from '@/Components/Pagination.vue';
import { CursorArrowRippleIcon, ChevronUpDownIcon,QuestionMarkCircleIcon, EyeIcon, PencilIcon, TrashIcon, UserGroupIcon } from '@heroicons/vue/24/solid';

import Create from '@/Pages/reporte/Create.vue';
import Edit from '@/Pages/reporte/Edit.vue';
import Delete from '@/Pages/reporte/Delete.vue';

import Checkbox from '@/Components/Checkbox.vue';
import InfoButton from '@/Components/InfoButton.vue';
import { PrimerasPalabras, vectorSelect, formatDate, CalcularEdad, number_format} from '@/global.js';

const { _, debounce, pickBy } = pkg
const props = defineProps({
    fromController: Object,
    total: Number,
    filters: Object,
    breadcrumbs: Object,
    perPage: Number,
    
    title: String,
    
    numberPermissions: Number,
})



const data = reactive({
    params: {
        search: props.filters.search,
        field: props.filters.field,
        order: props.filters.order,
        perPage: props.perPage,
    },
    selectedId: [],
    multipleSelect: false,
    createOpen: false,
    editOpen: false,
    deleteOpen: false,
    // deleteBulkOpen: false,
    dataSet: usePage().props.app.perpage
})

const order = (field) => {
    data.params.field = field
    console.log("🧈 debu data.params.field:", data.params.field);
    data.params.order = data.params.order === "asc" ? "desc" : "asc"
    console.log("🧈 debu data.params.order:", data.params.order);
}

watch(() => _.cloneDeep(data.params), debounce(() => {
    let params = pickBy(data.params)
    router.get(route("reporte.index"), params, {
        replace: true,
        preserveState: true,
        preserveScroll: true,
    })
}, 150))

const selectAll = (event) => {
    if (event.target.checked === false) {
        data.selectedId = []
    } else {
        props.reportes?.data.forEach((reporte) => {
            data.selectedId.push(reporte.id)
        })
    }
}
const select = () => {
    if (props.reportes?.data.length == data.selectedId.length) {
        data.multipleSelect = true
    } else {
        data.multipleSelect = false
    }
}


// const form = useForm({
//     archivo1: '',
// })

watchEffect(() => {
})


//text number dinero date datetime foreign
const titulos = [
    {order: 'codigo' , label: 'codigo', type: 'text'},
    {order: 'cantidad' , label: 'cantidad', type: 'number'},
    {order: 'fecha' , label: 'fecha'},
    {order: 'hora_inicial' , label: 'hora inicial', type: 'date'},
    {order: 'hora_final' , label: 'hora final', type: 'date'},
    {order: 'actividad_id' , label: 'actividad', type: 'foreign', nameid: 'actividad_s'},
    {order: 'centrotrabajo_id' , label: 'centrotrabajo', type: 'foreign', nameid: 'centrotrabajo_s'},
    {order: 'disponibilidad_id' , label: 'disponibilidad', type: 'foreign', nameid: 'disponibilidad_s'},
    {order: 'material_id' , label: 'material', type: 'foreign', nameid: 'material_s'},
    {order: 'operario_id' , label: 'operario', type: 'foreign', nameid: 'operario_s'},
    {order: 'ordentrabajo_id' , label: 'ordentrabajo', type: 'foreign', nameid: 'ordentrabajo_s'},
    {order: 'calendario_id' , label: 'calendario', type: 'foreign', nameid: 'calendario_s'},
    {order: 'pieza_id' , label: 'pieza', type: 'foreign', nameid: 'pieza_s'},
    {order: 'reproceso_id' , label: 'reproceso', type: 'foreign', nameid: 'reproceso_s'},
];

console.log(props.fromController)
</script>

<template>
    <Head :title="props.title" />

    <AuthenticatedLayout>
        <Breadcrumb :title="title" :breadcrumbs="breadcrumbs" />
        <div class="space-y-4">
            <div class="px-4 sm:px-0">
                <div class="rounded-lg overflow-hidden w-fit">
                    <PrimaryButton class="rounded-none" @click="data.createOpen = true" v-if="can(['create reporte'])">
                        {{ lang().button.add }}
                    </PrimaryButton>
                    <Create :show="data.createOpen" @close="data.createOpen = false" :title="props.title" v-if="can(['create reporte'])" 
                        />
                    <Edit :show="data.editOpen" @close="data.editOpen = false" :generica="data.generico" :title="props.title" v-if="can(['update reporte'])" 
                        />
                    <Delete :show="data.deleteOpen" @close="data.deleteOpen = false" :generica="data.generico"
                        v-if="can(['delete reporte'])" :title="props.title" />
                </div>
            </div>
            <div class="relative bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-between p-2">
                    <div class="flex space-x-2">
                        <SelectInput v-model="data.params.perPage" :dataSet="data.dataSet" />
                        <!-- <DangerButton @click="data.deleteBulkOpen = true"
                            v-show="data.selectedId.length != 0 && can(['delete reporte'])" class="px-3 py-1.5"
                            v-tooltip="lang().tooltip.delete_selected">
                            <TrashIcon class="w-5 h-5" />
                        </DangerButton> -->
                    </div>
                    <TextInput v-if="props.numberPermissions > 1" v-model="data.params.search" type="text"
                        class="block w-4/6 md:w-3/6 lg:w-2/6 rounded-lg"
                        placeholder="Nombre, correo, nivel o ID " />
                </div>
                <div class="overflow-x-auto scrollbar-table">
                    <table v-if="props.total > 0" class="w-full">
                        <thead class="uppercase text-sm border-t border-gray-200 dark:border-gray-700">
                            <tr class="dark:bg-gray-900/50 text-left">
                                <th class="px-2 py-4 text-center">
                                    <Checkbox v-model:checked="data.multipleSelect" @change="selectAll" />
                                </th>
                                <th class="px-2 py-4 text-center">#</th>
                                <th v-for="titulo in titulos" class="px-2 py-4 cursor-pointer" v-on:click="order(titulo['order'])">
                                    <div class="flex justify-between items-center">
                                        <span>{{ lang().label[titulo['label']] }}</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <!-- <th class="px-2 py-4 cursor-pointer" v-on:click="order('fecha_nacimiento')">
                                    <div class="flex justify-between items-center"> <span>{{ lang().label.edad }}</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th> -->

                                <th class="px-2 py-4">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(clasegenerica, indexu) in props.fromController.data" :key="indexu"
                                class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-200/30 hover:dark:bg-gray-900/20">
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center">
                                    <input
                                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-gray-800 dark:checked:bg-primary dark:checked:border-primary"
                                        type="checkbox" @change="select" :value="clasegenerica.id" v-model="data.selectedId" />
                                </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center">{{ ++indexu }}</td>
                                <td v-for="titulo in titulos" class="whitespace-nowrap py-4 px-2 sm:py-3">
                                    <span v-if="titulo['type'] == 'text'"> {{ clasegenerica[titulo['order']] }} </span>
                                    <span v-if="titulo['type'] == 'number'"> {{ number_format(clasegenerica[titulo['order']],0,false) }} </span>
                                    <span v-if="titulo['type'] == 'dinero'"> {{ number_format(clasegenerica[titulo['order']],0,true) }} </span>
                                    <span v-if="titulo['type'] == 'date'"> {{ formatDate(clasegenerica[titulo['order']],false) }} </span>
                                    <span v-if="titulo['type'] == 'datetime'"> {{ formatDate(clasegenerica[titulo['order']],true) }} </span>
                                    <span v-if="titulo['type'] == 'foreign'"> {{ clasegenerica[titulo['nameid']] }} </span>
                                </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3">
                                    <div class="flex justify-center items-center">
                                        <div class="rounded-md overflow-hidden">
                                            <InfoButton v-show="can(['update reporte'])" type="button"
                                                @click="(data.editOpen = true), (data.reporte = clasegenerica)"
                                                class="px-2 py-1.5 rounded-none" v-tooltip="lang().tooltip.edit">
                                                <PencilIcon class="w-4 h-4" />
                                            </InfoButton>
                                            <DangerButton v-show="can(['delete reporte'])" type="button"
                                                @click="(data.deleteOpen = true), (data.reporte = clasegenerica)"
                                                class="px-2 py-1.5 rounded-none" v-tooltip="lang().tooltip.delete">
                                                <TrashIcon class="w-4 h-4" />
                                            </DangerButton>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h2 v-else class="text-center text-xl my-8">Sin Registros</h2>
                </div>
                <div v-if="props.total > 0" class="flex justify-between items-center p-2 border-t border-gray-200 dark:border-gray-700">
                    <Pagination :links="props.fromController" :filters="data.params" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
