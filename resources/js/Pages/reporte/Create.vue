<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import vSelect from "vue-select"; import "vue-select/dist/vue-select.css";
import { reactive, watch, onMounted, ref, watchEffect } from 'vue';

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { LookForValueInArray, formatTime, formatDate, TransformTdate } from '@/global.ts';

// --------------------------- ** -------------------------

const props = defineProps({
    show: Boolean,
    title: String,
    roles: Object,
    
    losSelect: Object,
    numberPermissions: Number,
    valuesGoogleCabeza: Object,
    valuesGoogleBody: Object,
    Trabajadores: Object,
})
const emit = defineEmits(["close"]);

const data = reactive({
    params: {
        pregunta: ''
    },
    tipoReporte:{ title: 'Actividad', value: 0 },
    actividad_id:props.losSelect.actividad,
    centrotrabajo_id:props.losSelect.centrotrabajo,
    disponibilidad_id:props.losSelect.disponibilidad,
    // material_id:props.losSelect.material,
    ordentrabajo_id:props.losSelect.ordentrabajo,
    // pieza_id:props.losSelect.pieza,
    reproceso_id:props.losSelect.reproceso,
    temp_disponibilidad_id:null,
    temp_reproceso_id:null,
    temp_actividad_id:null,
    valorInactivo:'NA',
    cabeza: props.valuesGoogleCabeza,
    // nombresOT: (props.valuesGoogleBody),
    nombresOT: Object.values(props.valuesGoogleBody),
    ordentrabajo_ids: [],
    mensajeFalta: '',
})

// console.log("🧈 debu nombresOT:", data.nombresOT);

//very usefull
const justNames = [
    // 'codigo',
    'tipoReporte',
    'fecha',
    'hora_inicial',
    'hora_final',
    'actividad_id',
    'centrotrabajo_id',
    'disponibilidad_id',
    'operario_id',
    'ordentrabajo_id',
    'reproceso_id',

    // 'material_id',
    // 'pieza_id',
    // 'cantidad',

    'ordentrabajo_ids',
    'otitem',
    'tiempoEstimado',
    'user_id'

]; const form = useForm({ ...Object.fromEntries(justNames.map(field => [field, ''])) });

onMounted(() => {
    if(props.numberPermissions > 8){

        // const valueRAn = Math.floor(Math.random() * (9 - 0) + 0)
        // form.codigo = 'AdminCod'+ (valueRAn);
        // form.hora_inicial = '0'+valueRAn+':00'//temp
        // form.fecha = '2023-06-01'
    }

});

watchEffect(() => {
    if (props.show) {
        form.errors = {}
        let currentDate = new Date();
        if(form.fecha === null || form.fecha === ''){
            form.fecha = (TransformTdate(currentDate,'')).substring(0,10);
            form.hora_inicial = formatTime()
        }

        data.ordentrabajo_ids = data.nombresOT.map((val,inde) => ({
            // title: val[1]?.replace(/_/g, " "),
            title: val.Item?.replace(/_/g, " "),
            value: inde,
            // value: inde.id
        }))

        // let currentDate = new Date();
        // form.fecha = (TransformTdate(currentDate,'')).substring(0,10);
        // form.hora_inicial = formatTime().substring(0,5)


        // console.log("🧈 debu form.hora_inicial:", form.hora_inicial);
    }
})
//the real order
const printForm = [
    { idd: 'fecha', label: 'fecha', type: 'date', value: form.fecha , elif:null},
    { idd: 'hora_inicial', label: 'hora inicial', type: 'time', value: form.hora_inicial , elif:null},
    // { idd: 'hora_final', label: 'hora final', type: 'time', value: form.hora_final , elif:null},
    
    { idd: 'ordentrabajo_ids', label: 'Orden de trabajo', type: 'id', value: form.ordentrabajo_id , elif:null},


    { idd: 'centrotrabajo_id', label: 'Centro de trabajo', type: 'id', value: form.centrotrabajo_id , elif:null},

    //3 opciones
    { idd: 'actividad_id', label: 'Actividad', type: 'id', value: form.actividad_id , elif:null},
    { idd: 'disponibilidad_id', label: 'Disponibilidad (paro)', type: 'id', value: form.disponibilidad_id, elif:null },
    { idd: 'reproceso_id', label: 'Reproceso', type: 'id', value: form.reproceso_id, elif:null },
    
    //opcionales
    // { idd: 'codigo', label: 'codigo', type: 'text', value: form.codigo , elif:null},
    // { idd: 'material_id', label: 'Material', type: 'id', value: form.material_id , elif:null},
    // { idd: 'pieza_id', label: 'Pieza', type: 'id', value: form.pieza_id, elif:null },
    // { idd: 'cantidad', label: 'cantidad (pieza)', type: 'text', value: form.cantidad, elif:'pieza_id' },

    // { idd: 'operario_id', label: 'Operario', type: 'id', value: form.operario_id },
];

let ValidarNotNull = (campos) =>{
    let sonObligatorios = '';
    try{
        campos.forEach((value,i) => {
            if(typeof form[value] === 'undefined' || form[value] === null || form[value].length === 0){ //&& form[value] != ''
                sonObligatorios = value
                console.log("🧈 debu value:", value);
                throw new Error('BreakException');
            }
        })
    } catch (e) {
        // if (e.message !== 'BreakException') throw e;
    }
    return sonObligatorios;
}

let ValidarCreateReporte = () =>{
    let tipo = data.tipoReporte.value;
    let result = true;
    const mensaje = ' es obligatorio'
    if(tipo == 0){
        result = ValidarNotNull([
            'ordentrabajo_ids',
            'centrotrabajo_id',
            'actividad_id',
        ])
    } //acti

    if(tipo == 1) {
        result = ValidarNotNull([
            'centrotrabajo_id',
            'ordentrabajo_ids',
            'actividad_id',
            'reproceso_id',
        ])
    } //reproceso

    if(tipo == 2) {
        result = ValidarNotNull([
            'centrotrabajo_id',
            'disponibilidad_id',
        ])
    } //disponibilidad

    let objectMessages = {
        'ordentrabajo_ids':'Orden trabajo',
        'actividad_id':'Actividad',
        'reproceso_id':'Reproceso',
        'centrotrabajo_id':'Centro de trabajo',
        'disponibilidad_id':'Disponibilidad',
    }
    if(result != '') return objectMessages[result] + mensaje
    else return result
}


const create = () => {
    form.ordentrabajo_id = form.ordentrabajo_ids
    form.tipoReporte = data.tipoReporte

    data.mensajeFalta = ValidarCreateReporte();
    if(data.mensajeFalta == ''){
    form.post(route('reporte.store'), {
        preserveScroll: true,
        onSuccess: () => {
            emit("close")
            form.reset()
        },
        onError: () => alert(JSON.stringify(form.errors, null, 4)),
        onFinish: () => null,
    })
    }

}

watch(() => data.tipoReporte, (newX) => { 
    form.reset()

})

//very usefull
const opcinesActividadOTros = [{ title: 'Actividad', value: 0 }, { title: 'Reproceso', value: 1 }, { title: 'Disponibilidad(paro)', value: 2 }];
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
                    <div v-if="props.numberPermissions > 8" id="opcinesActividadO" class="xl:col-span-2">
                        <label name=""> Reportar en nombre de: </label>
                        <v-select :options="props.Trabajadores" label="title"
                        v-model="form.user_id"></v-select>
                    </div>
                    <div id="opcinesActividadO" class="xl:col-span-2">
                        <label name=""> Tipo de reporte </label>
                        <v-select :options="opcinesActividadOTros" label="title"
                        v-model="data.tipoReporte"></v-select>
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


                    <div id="Sordentrabajo" v-if="data.tipoReporte.value != 2">
                        <label name="ordentrabajo_ids"> Orden de trabajo </label>
                        <v-select :options="data['ordentrabajo_ids']" label="title"
                            v-model="form['ordentrabajo_ids']"
                        ></v-select>
                        <InputError class="mt-2" :message="form.errors['ordentrabajo_id']" />
                    </div>

                    
                    <!-- <div v-if="form.ordentrabajo_ids && data.tipoReporte.value != 2" v-for="index in [0,1]" :key="index" class="w-full col-span-2">
                        <InputLabel :for="index" :value="arrayMostrarDelCodigo[index]" />
                        <TextInput :id="index" type="text" disabled class="mt-1 block w-full bg-gray-200" 
                            :value="data.nombresOT[form.ordentrabajo_ids.value][Cabezera[index]]" 
                        />
                    </div> -->
                    <div v-if="form.ordentrabajo_ids && data.tipoReporte.value != 2" class="w-full col-span-2">
                        <InputLabel :for="index" :value="arrayMostrarDelCodigo[0]" />
                        <TextInput :id="index" type="text" disabled class="mt-1 block w-full bg-gray-200" 
                            :value="data.nombresOT[form.ordentrabajo_ids.value][Cabezera[0]]" 
                        />
                    </div>

                    <div v-if="form.ordentrabajo_ids && data.tipoReporte.value != 2" class="w-full col-span-1">
                        <InputLabel :for="index" :value="arrayMostrarDelCodigo[1]" />
                        <TextInput :id="index" type="text" disabled class="mt-1 block w-full bg-gray-200" 
                            :value="data.nombresOT[form.ordentrabajo_ids.value][Cabezera[1]]" 
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


                <div class=" mb-8 mt-[230px] flex justify-end">
                    <h2 v-if="data.mensajeFalta != ''" class="mx-12 px-8 text-lg font-medium text-red-700 bg-red-50 dark:text-gray-100"> 
                        {{ data.mensajeFalta }} 
                    </h2>

                    <SecondaryButton :disabled="form.processing" @click="emit('close')"> {{ lang().button.close }}
                    </SecondaryButton>
                    <PrimaryButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="create">
                        {{ form.processing ? lang().button.add + '...' : lang().button.add }}
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