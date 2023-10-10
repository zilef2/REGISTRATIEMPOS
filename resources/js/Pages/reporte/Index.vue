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
import { ChevronUpDownIcon, CheckCircleIcon, PencilIcon, TrashIcon } from '@heroicons/vue/24/solid';

import Create from '@/Pages/reporte/Create.vue';
import Edit from '@/Pages/reporte/Edit.vue';
import TerminarReporte from '@/Pages/reporte/TerminarReporte.vue';
import Delete from '@/Pages/reporte/Delete.vue';
import DeleteBulk from '@/Pages/reporte/DeleteBulk.vue';

import Checkbox from '@/Components/Checkbox.vue';
import InfoButton from '@/Components/InfoButton.vue';
import ClockWorking from '@/Components/uiverse/ClockWorking.vue';

import { TimeTo12Format, formatDate, CalcularAvg, number_format } from '@/global.ts';

const { _, debounce, pickBy } = pkg
const props = defineProps({
    fromController: Object,
    total: Number,
    filters: Object,
    breadcrumbs: Object,
    perPage: Number,

    title: String,

    numberPermissions: Number,
    losSelect: Object,
    valuesGoogleCabeza: Object,
    valuesGoogleBody: Object,
    Trabajadores: Object,
})

const data = reactive({
    params: {
        search: props.filters.search,
        field: props.filters.field,
        order: props.filters.order,
        perPage: props.perPage,
    },
    generico: null,
    selectedId: [],
    multipleSelect: false,
    createOpen: false,
    editOpen: false,
    TerminarOpen: false,
    deleteOpen: false,
    dataSet: usePage().props.app.perpage,
    totalEmpleados: 0,

    deleteBulkOpen: false,
})

const order = (field) => {
    data.params.field = field
    data.params.order = data.params.order === "asc" ? "desc" : "asc"
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
        props.fromController?.data.forEach((reporte) => {
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
// text // number // dinero // date // datetime // foreign
const titulos = [
    // { order: 'codigo', label: 'codigo', type: 'text' },
    { order: 'fecha', label: 'fecha', type: 'date' },
    { order: 'operario_id', label: 'operario', type: 'foreign', nameid: 'operario_s' },
    { order: 'hora_inicial', label: 'hora inicial', type: 'time' },
    { order: 'hora_final', label: 'hora final', type: 'time' },
    { order: 'actividad_id', label: 'actividad', type: 'foreign', nameid: 'actividad_s' },
    { order: 'centrotrabajo_id', label: 'centrotrabajo', type: 'foreign', nameid: 'centrotrabajo_s' },
    // { order: 'ordentrabajo_id', label: 'ordentrabajo', type: 'foreign', nameid: 'ordentrabajo_s' },
    { order: 'OTItem', label: 'ordentrabajo', type: 'text' },
    { order: 'TiempoEstimado', label: 'TiempoEstimado', type: 'text' },

    // { order: 'pieza_id', label: 'pieza', type: 'foreign', nameid: 'pieza_s' },
    // { order: 'cantidad', label: 'cantidad', type: 'number' },

    { order: 'disponibilidad_id', label: 'disponibilidad', type: 'foreign', nameid: 'disponibilidad_s' },
    { order: 'reproceso_id', label: 'reproceso', type: 'foreign', nameid: 'reproceso_s' },

    // {order: 'calendario_id' , label: 'calendario', type: 'foreign', nameid: 'calendario_s'},
];

</script>

<template>
    <Head :title="props.title" />

    <AuthenticatedLayout>
        <Breadcrumb :title="title" :breadcrumbs="breadcrumbs" />
        <div class="space-y-4">
            <!-- {{ props.fromController.data[2] }} -->
            <div class="px-4 sm:px-0">
                <div class="rounded-lg overflow-hidden w-fit">
                    <PrimaryButton class="rounded-none" @click="data.createOpen = true" v-if="can(['create reporte'])">
                        {{ lang().button.add }}
                    </PrimaryButton>

                    <Create v-if="can(['create reporte'])" :numberPermissions="props.numberPermissions"
                        :show="data.createOpen" @close="data.createOpen = false" :title="props.title"
                        :losSelect=props.losSelect
                        :valuesGoogleCabeza=props.valuesGoogleCabeza
                        :valuesGoogleBody=props.valuesGoogleBody
                        :Trabajadores=props.Trabajadores
                    />

                    <Edit v-if="can(['update reporte']) && numberPermissions > 1" :numberPermissions="props.numberPermissions" 
                        :show="data.editOpen"
                        @close="data.editOpen = false" :generica="data.generico" :title="props.title"
                        :losSelect=props.losSelect
                        :valuesGoogleCabeza=props.valuesGoogleCabeza
                        :valuesGoogleBody=props.valuesGoogleBody
                        :Trabajadores=props.Trabajadores
                    />

                    <TerminarReporte v-if="can(['read reporte'])" :numberPermissions="props.numberPermissions" :show="data.TerminarOpen"
                        @close="data.TerminarOpen = false" :generica="data.generico" :title="props.title"
                        />

                    <Delete v-if="can(['delete reporte'])" :numberPermissions="props.numberPermissions"
                        :show="data.deleteOpen" @close="data.deleteOpen = false" :generica="data.generico"
                        :title="props.title" />

                    <DeleteBulk :show="data.deleteBulkOpen"
                        @close="data.deleteBulkOpen = false, data.multipleSelect = false, data.selectedId = []"
                        :selectedId="data.selectedId" :title="props.title" />
                </div>
            </div>
            <div class="relative bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-between p-2">
                    <div class="flex space-x-2">
                        <SelectInput v-model="data.params.perPage" :dataSet="data.dataSet" />
                        <DangerButton @click="data.deleteBulkOpen = true"
                            v-show="data.selectedId.length != 0 && can(['delete reporte'])" class="px-3 py-1.5"
                            v-tooltip="lang().tooltip.delete_selected">
                            <TrashIcon class="w-5 h-5" />
                        </DangerButton>
                    </div>
                    <TextInput v-if="props.numberPermissions > 1" v-model="data.params.search" type="text"
                        class="block w-4/6 md:w-3/6 lg:w-2/6 rounded-lg" placeholder="codigo o fecha " />
                </div>
                <div class="overflow-x-auto scrollbar-table">
                    <table v-if="props.total > 0" class="w-full">
                        <thead class="uppercase text-sm border-t border-gray-200 dark:border-gray-700">
                            <tr class="dark:bg-gray-900/50 text-left">
                                <th v-if="props.numberPermissions > 1" class="px-2 py-4 text-center">
                                    <Checkbox v-model:checked="data.multipleSelect" @change="selectAll" />
                                </th>
                                <th class="px-2 py-4">Accion</th>

                                <th class="px-2 py-4 text-center">#</th>
                                <th v-for="titulo in titulos" class="px-2 py-4 cursor-pointer min-w-min"
                                    v-on:click="order(titulo['order'])">
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

                            </tr>
                        </thead>
                        <!-- {{ props.fromController.data[0] }} -->
                        <tbody>
                            <tr v-for="(clasegenerica, indexu) in props.fromController.data" :key="indexu"
                                class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-200/30 hover:dark:bg-gray-900/20">
                                <td v-if="props.numberPermissions > 1" class="whitespace-nowrap py-4 px-2 sm:py-3 text-center">
                                    <input 
                                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-gray-800 dark:checked:bg-primary dark:checked:border-primary"
                                        type="checkbox" @change="select" :value="clasegenerica.id"
                                        v-model="data.selectedId" />
                                </td>
                                <td class="whitespace-nowrap py-4 w-12 px-2 sm:py-3">
                                    <div class="flex justify-center items-center">
                                        <div class="rounded-md overflow-hidden">
                                            <InfoButton v-show="can(['update reporte'])" type="button"
                                                @click="(data.editOpen = true), (data.generico = clasegenerica)"
                                                class="px-2 py-1.5 rounded-none" v-tooltip="lang().tooltip.edit">
                                                <PencilIcon class="w-4 h-4" />
                                            </InfoButton>
                                            <InfoButton v-if="!clasegenerica.hora_final" v-show="can(['create reporte'])" type="button"
                                                @click="(data.TerminarOpen = true), (data.generico = clasegenerica)"
                                                class="px-2 py-1.5 rounded-none" v-tooltip="lang().tooltip.edit">
                                                <CheckCircleIcon class="w-4 h-4" />
                                            </InfoButton>
                                            <DangerButton v-show="can(['delete reporte'])" type="button"
                                                @click="(data.deleteOpen = true), (data.generico = clasegenerica)"
                                                class="px-2 py-1.5 rounded-none" v-tooltip="lang().tooltip.delete">
                                                <TrashIcon class="w-4 h-4" />
                                            </DangerButton>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center">{{ ++indexu }}</td>
                                <td v-for="titulo in titulos" class="whitespace-nowrap py-4 px-2 sm:py-3">
                                    <span v-if="titulo['type'] == 'text'"> {{ clasegenerica[titulo['order']] }} </span>
                                    <!-- <span v-if="titulo['type'] == 'time'"> {{ (clasegenerica[titulo['order']]).slice(0,-3) }} </span> -->
                                    <span v-if="titulo['type'] == 'time'"> {{ TimeTo12Format(clasegenerica[titulo['order']]) }} </span>
                                    <span v-if="titulo['type'] == 'number'"> {{ number_format(clasegenerica[titulo['order']], 0, false) }} </span>
                                    <span v-if="titulo['type'] == 'dinero'"> {{ number_format(clasegenerica[titulo['order']], 0, true) }} </span>
                                    <span v-if="titulo['type'] == 'date'"> {{ formatDate(clasegenerica[titulo['order']], '') }} </span>
                                    <span v-if="titulo['type'] == 'datetime'"> {{ formatDate(clasegenerica[titulo['order']], 'conLaHora') }} </span>
                                    <span v-if="titulo['type'] == 'foreign'"> {{ clasegenerica[titulo['nameid']] }} </span>
                                    <span v-if="titulo['order'] == 'hora_final' && clasegenerica[titulo['order']] == null">
                                        <ClockWorking />
                                    </span>
                                </td>
                            </tr>

                            <!-- totales -->
                            <!-- <tr>
                                <td class="whitespace-nowrap py-4 w-12 px-2 sm:py-3 text-center"> </td>
                                <td class="whitespace-nowrap py-4 w-12 px-2 sm:py-3 text-center"> </td>
                                <td v-if="numberPermissions > 1" class="whitespace-nowrap py-4 w-12 px-2 sm:py-3 text-center"> </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center"> </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 font-extrabold text-center"> Hora inicial Promedio: </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center">
                                    {{ CalcularAvg(props.fromController.data, 'hora_inicial', true) }}
                                </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center"> </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center"> </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center"> </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 font-extrabold text-center"> Tiempo Estimado Promedio: </td>
                                <td class="whitespace-nowrap py-4 px-2 sm:py-3 text-center">
                                    {{ CalcularAvg(props.fromController.data, 'TiempoEstimado') }}
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                    <h2 v-else class="text-center text-xl my-8">Sin Registros</h2>
                </div>
                <div v-if="props.total > 0"
                    class="flex justify-between items-center p-2 border-t border-gray-200 dark:border-gray-700">
                    <Pagination :links="props.fromController" :filters="data.params" />
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
