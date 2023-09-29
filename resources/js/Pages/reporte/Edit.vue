<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { watchEffect, reactive } from 'vue';
import vSelect from "vue-select"; import "vue-select/dist/vue-select.css";
import VueDatePicker from '@vuepic/vue-datepicker';

import { LookForValueInArray } from '@/global.ts';

const props = defineProps({
    show: Boolean,
    title: String,
    generica: Object,
    losSelect: Object,
    numberPermissions: Number,
    valuesGoogleCabeza: Object,
    valuesGoogleBody: Object,
    Trabajadores: Object,
})

const emit = defineEmits(["close"]);
const data = reactive({
    actualizarCadaReporte:true,
    justNames: [
        // 'codigo',
        // 'cantidad',
        'fecha',
        'hora_inicial',

        'actividad_id',
        'centrotrabajo_id',
        'disponibilidad_id',
        // 'material_id',
        'operario_id',
        'ordentrabajo_id',
        // 'calendario_id',
        // 'pieza_id',
        'reproceso_id'
    ],
    tipoReporte:{ title: 'Actividad', value: 0 },

    valorInactivo:'NA',
    cabeza: props.valuesGoogleCabeza,
    nombresOT: Object.values(props.valuesGoogleBody),

    // select
    actividad_id:props.losSelect.actividad,
    centrotrabajo_id:props.losSelect.centrotrabajo,
    disponibilidad_id:props.losSelect.disponibilidad,
    ordentrabajo_id:props.losSelect.ordentrabajo,
    reproceso_id:props.losSelect.reproceso,
    ordentrabajo_ids: [],
    mensajeFalta: '',

});const form = useForm({ ...Object.fromEntries(data.justNames.map(field => [field, ''])) });

const opcinesActividadOTros = [{ title: 'Actividad', value: 0 }, { title: 'Reproceso', value: 1 }, { title: 'Disponibilidad(paro)', value: 2 }];

watchEffect(() => {
    if (props.show) {
        // data.justNames.forEach(element => {
        //     form[element] =  props.generica[element]
        // });
        form.errors = {}

        if(data.actualizarCadaReporte){
            form.tipoReporte = opcinesActividadOTros[props.generica?.tipoReporte]
            data.tipoReporte = form.tipoReporte
            data.ordentrabajo_ids = data.nombresOT.map((val,inde) => ({
                title: val.Item?.replace(/_/g, " "),
                value: inde,
            }))
            
            form.ordentrabajo_id = data.ordentrabajo_ids[props.generica?.ordentrabajo_id]['title']
            console.log("🧈 debu data:", data.ordentrabajo_ids[0]);

            
            form.centrotrabajo_id = data.centrotrabajo_id[props.generica?.centrotrabajo_id]['title']
            form.actividad_id = props.generica?.actividad_s

            form.cantidad = props.generica?.cantidad
            form.fecha = props.generica?.fecha
            form.hora_inicial = props.generica?.hora_inicial

            form.disponibilidad_id = props.generica?.disponibilidad_s
            form.material_id = props.generica?.material_s
            form.operario_id = props.generica?.operario_s
            form.calendario_id = props.generica?.calendario_s
            form.pieza_id = props.generica?.pieza_s
            form.reproceso_id = props.generica?.reproceso_s

            data.actualizarCadaReporte=false
        }

    }else{
        data.actualizarCadaReporte=true
    }
})


const update = () => {

    let StringResultAny = LookForValueInArray(props.losSelect.actividad,form.actividad_id)
    form.actividad_id = StringResultAny != '' ? StringResultAny : '';

    StringResultAny = LookForValueInArray(props.losSelect.centrotrabajo,form.centrotrabajo_id)
    form.centrotrabajo_id = StringResultAny != '' ? StringResultAny : '';

    StringResultAny = LookForValueInArray(props.losSelect.disponibilidad,form.disponibilidad_id)
    form.disponibilidad_id = StringResultAny != '' ? StringResultAny : '';

    StringResultAny = LookForValueInArray(data['ordentrabajo_ids'],form.ordentrabajo_id)
    form.ordentrabajo_id = StringResultAny != '' ? StringResultAny : '';

    StringResultAny = LookForValueInArray(props.losSelect.reproceso,form.reproceso_id)
    form.reproceso_id = StringResultAny != '' ? StringResultAny : '';

    
    //     form.centrotrabajo_id = props.generica?.centrotrabajo_s
    //     form.disponibilidad_id = props.generica?.disponibilidad_s
    //     form.material_id = props.generica?.material_s
    //     form.ordentrabajo_id = props.generica?.ordentrabajo_s
    //     form.pieza_id = props.generica?.pieza_s
    //     form.reproceso_id = props.generica?.reproceso_s

    form.put(route('reporte.update', props.generica?.id), {
        preserveScroll: true,
        onSuccess: () => {
            emit("close")
            form.reset()
        },
        onError: () => null,
        onFinish: () => null,
    })
}

const arrayMostrarDelCodigo = ['Nombre Tablero','OT+Item','% avance','Tiempo estimado'];
const Cabezera = ['Nombre_tablero','avance'];
const CT_Num_to_Tiempo = [
    'Tiempo_estimado_cableado',
    'Tiempo_estimado_cobre',
    'Tiempo_estimado_corte',
    'Tiempo_estimado_doblez',
    'Tiempo_estimado_ensamble',
    'Tiempo_estimado_pulida',
    'Tiempo_estimado_soldadura',

    'Tiempo_estimado_Ing_elec',
    'Tiempo_estimado_Ing_mec',
];
</script>


<template>
    <section class="space-y-6">
        <Modal :show="props.show" @close="emit('close')">
            <form class="px-6 my-8" @submit.prevent="create">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ lang().label.add }} {{ props.title }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                    <div v-if="props.numberPermissions > 1" id="opcinesActividadO" class="xl:col-span-2">
                        <label name=""> Reportar en nombre de: </label>
                        <v-select :options="props.Trabajadores" label="title"
                        v-model="form.user_id"></v-select>
                    </div>
                    <div id="opcinesActividadO" class="xl:col-span-2">
                        <label name=""> Tipo de reporte </label>
                        <v-select :options="opcinesActividadOTros" label="title"
                        v-model="data.tipoReporte" disabled></v-select>
                    </div>
                    <!-- empieza -->

                    <div class="xl:col-span-1">
                        <InputLabel for="fecha" :value="lang().label['fecha']" />
                        <TextInput id="fecha" type="date" class="mt-1 block w-full bg-gray-200"
                            v-model="form['fecha']" disabled placeholder="fecha"
                            :error="form.errors['fecha']" />
                        <InputError class="mt-2" :message="form.errors['fecha']" />
                    </div>
                    <div class="">
                        <InputLabel for="hora_inicial" :value="lang().label['hora inicial']" />
                        <TextInput id="hora_inicial" type="time" class="mt-1 block w-full bg-gray-200"
                            v-model="form['hora_inicial']" disabled placeholder="hora_inicial"
                            :error="form.errors['hora_inicial']" step="3600" />
                        <InputError class="mt-2" :message="form.errors['hora_inicial']" />
                    </div>

                    <div id="Sordentrabajo" v-if="data.tipoReporte.value != 2" class="xl:col-span-2">
                        <label name="ordentrabajo_ids"> Orden de trabajo </label>
                        <v-select :options="data['ordentrabajo_ids']" label="title"
                            v-model="form['ordentrabajo_id']"
                        ></v-select>
                        <InputError class="mt-2" :message="form.errors['ordentrabajo_id']" />
                    </div>
                    <div v-if="form.ordentrabajo_id && data.tipoReporte.value != 2" class="w-full col-span-2">
                        <InputLabel :for="index" :value="arrayMostrarDelCodigo[0]" />
                        <TextInput :id="index" type="text" disabled class="mt-1 block w-full bg-gray-200" 
                            :value="data.nombresOT[props.generica?.ordentrabajo_id][Cabezera[0]]" 
                        />
                    </div> 

                    <div v-if="form.ordentrabajo_id && data.tipoReporte.value != 2" class="w-full col-span-1">
                        <InputLabel :for="index" :value="arrayMostrarDelCodigo[1]" />
                        <TextInput :id="index" type="text" disabled class="mt-1 block w-full bg-gray-200" 
                            :value="data.nombresOT[props.generica?.ordentrabajo_id][Cabezera[1]]" 
                        />
                    </div>

                    <div id="Scentrotrabajo" >
                        <label name="centrotrabajo_id"> Centro de trabajo </label>
                        <v-select :options="data['centrotrabajo_id']" label="title"
                            v-model="form['centrotrabajo_id']"
                        ></v-select>
                        <InputError class="mt-2" :message="form.errors['centrotrabajo_id']" />
                    </div>
                    <!-- tiempo estimado -->
                    <div v-if="form.ordentrabajo_ids && form.centrotrabajo_id && data.tipoReporte.value != 2">
                        <InputLabel :for="index" :value="arrayMostrarDelCodigo[3]" />
                        <TextInput :id="index" type="text" disabled class="mt-1 block w-full bg-gray-200" 
                            :value="data.nombresOT[form.ordentrabajo_ids.value][CT_Num_to_Tiempo[form['centrotrabajo_id']['value']]]" />
                    </div>

                    <!-- eleccion -->
                    <div id="actividad" v-if="data.tipoReporte.value == 0 || data.tipoReporte.value == 1" class="col-span-2">
                        <label name="actividad_id"> Actividad </label>
                        <v-select :options="data['actividad_id']" label="title" required
                            v-model="form['actividad_id']"
                        ></v-select>
                        <InputError class="mt-2" :message="form.errors['actividad_id']" />
                    </div>
                    <div id="reproceso" v-if="data.tipoReporte.value == 1" class="col-span-2">
                        <label name="reproceso_id"> Reproceso</label>
                        <v-select :options="data['reproceso_id']" label="title" required
                            v-model="form['reproceso_id']"
                        ></v-select>
                        <InputError class="mt-2" :message="form.errors['reproceso_id']" />
                    </div>
                    <div id="disponibilidad" v-if="data.tipoReporte.value == 2" class="col-span-3">
                        <label name="disponibilidad_id"> Disponibilidad</label>
                        <v-select :options="data['disponibilidad_id']" label="title" required
                            v-model="form['disponibilidad_id']"
                        ></v-select>
                        <InputError class="mt-2" :message="form.errors['disponibilidad_id']" />
                    </div>
                    <!-- termina -->
                </div>


                <div class=" mb-8 mt-[290px] flex justify-end">
                    <h2 v-if="data.mensajeFalta != ''" class="mx-12 px-8 text-lg font-medium text-red-700 bg-red-50 dark:text-gray-100"> 
                        {{ data.mensajeFalta }} 
                    </h2>

                    <SecondaryButton :disabled="form.processing" @click="emit('close')"> {{ lang().button.close }}
                    </SecondaryButton>
                    <PrimaryButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="update">
                        {{ form.processing ? lang().button.save + '...' : lang().button.save }}
                    </PrimaryButton>
                </div>
            </form>
        </Modal>
    </section>
</template>

<style>
    textarea {
        @apply px-3 py-2 border border-gray-300 rounded-md;
    }

    [name="labelSelectVue"],
    .muted {
        color: #1b416699;
    }

    [name="labelSelectVue"] {
        /* font-size: 22px; */
        font-weight: 600;
    }
</style>