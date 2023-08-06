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
    material_id:props.losSelect.material,
    ordentrabajo_id:props.losSelect.ordentrabajo,
    pieza_id:props.losSelect.pieza,
    reproceso_id:props.losSelect.reproceso,
    temp_disponibilidad_id:null,
    temp_reproceso_id:null,
    temp_actividad_id:null,
    valorInactivo:'NA',
})

//very usefull
const justNames = [
    'codigo',
    'cantidad',
    'fecha',
    'hora_inicial',
    'hora_final',
    'actividad_id',
    'centrotrabajo_id',
    'disponibilidad_id',
    'material_id',
    'operario_id',
    'ordentrabajo_id',
    'pieza_id',
    'reproceso_id'
    // 'calendario_id',
]; const form = useForm({ ...Object.fromEntries(justNames.map(field => [field, ''])) });


onMounted(() => {
    if(props.numberPermissions > 8){
        const valueRAn = Math.floor(Math.random() * (9 - 0) + 0)
        form.codigo = 'AdminCod'+ (valueRAn);
        form.hora_inicial = '0'+valueRAn+':00'//temp
        form.fecha = '2023-06-01'
    }else{
        let currentDate = new Date();
        form.fecha = (TransformTdate(currentDate,'')).substring(0,10);
        form.hora_inicial = formatTime()
    }
});

//the real order
const printForm = [
    { idd: 'codigo', label: 'codigo', type: 'text', value: form.codigo , elif:null},
    { idd: 'fecha', label: 'fecha', type: 'date', value: form.fecha , elif:null},
    { idd: 'hora_inicial', label: 'hora inicial', type: 'time', value: form.hora_inicial , elif:null},
    // { idd: 'hora_final', label: 'hora final', type: 'time', value: form.hora_final , elif:null},
    
    { idd: 'ordentrabajo_id', label: 'Orden de trabajo', type: 'id', value: form.ordentrabajo_id , elif:null},
    { idd: 'centrotrabajo_id', label: 'Centro de trabajo', type: 'id', value: form.centrotrabajo_id , elif:null},

    //3 opciones
    { idd: 'actividad_id', label: 'Actividad', type: 'id', value: form.actividad_id , elif:null},
    { idd: 'disponibilidad_id', label: 'Disponibilidad (paro)', type: 'id', value: form.disponibilidad_id, elif:null },
    { idd: 'reproceso_id', label: 'Reproceso', type: 'id', value: form.reproceso_id, elif:null },
    
    //opcionales
    { idd: 'material_id', label: 'Material', type: 'id', value: form.material_id , elif:null},
    { idd: 'pieza_id', label: 'Pieza', type: 'id', value: form.pieza_id, elif:null },
    { idd: 'cantidad', label: 'cantidad (pieza)', type: 'text', value: form.cantidad, elif:'pieza_id' },

    // { idd: 'operario_id', label: 'Operario', type: 'id', value: form.operario_id },
];


const create = () => {
    // console.log("🧈 debu pieza_id:", form.pieza_id);
    form.post(route('reporte.store'), {
        preserveScroll: true,
        onSuccess: () => {
            emit("close")
            form.reset()
        },
        onError: () => null,
        onFinish: () => null,
    })
}

watch(() => data.tipoReporte, (newX) => {
    if( data.tipoReporte.value == 0 ){  //actividad
        form.disponibilidad_id = data.valorInactivo
        form.reproceso_id = data.valorInactivo
        form.actividad_id = form.actividad_id == data.valorInactivo ? '' : props.losSelect.actividad_id
        console.log("🧈 debu props.losSelect.actividad_id:", props.losSelect.actividad_id);
    }
    if( data.tipoReporte.value == 1 ){  //reproceso
        form.disponibilidad_id = data.valorInactivo
        form.actividad_id = data.valorInactivo
        // form.actividad_id = data.temp_reproceso_id
        form.reproceso_id = form.reproceso_id == data.valorInactivo ? '' : props.losSelect.reproceso_id
    }
    console.log("🧈 debu form.disponibilidad_id:", form.disponibilidad_id);
    if( data.tipoReporte.value == 2 ){  //disponibilidad
        form.actividad_id = data.valorInactivo
        form.reproceso_id = data.valorInactivo
        // form.actividad_id = data.temp_disponibilidad_id
        form.disponibilidad_id = form.disponibilidad_id == data.valorInactivo ? '' : props.losSelect.disponibilidad_id
    }
})

watchEffect(() => {
    if (props.show) {
        form.errors = {}
    }
})


//TOSTUDY
// const roles = props.roles?.map(role => ({
//     label: role.name.replace(/_/g, " "),
//     value: (role.name)
// }))

//very usefull
const opcinesActividadOTros = [{ title: 'Actividad', value: 0 }, { title: 'Reproceso', value: 1 }, { title: 'Disponibilidad(paro)', value: 2 }];
</script>

<template>
    <section class="space-y-6">
        <Modal :show="props.show" @close="emit('close')">
            <form class="p-6" @submit.prevent="create">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ lang().label.add }} {{ props.title }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div id="opcinesActividadO" >
                        <label name=""> Tipo de reporte </label>
                        <v-select :options="opcinesActividadOTros" label="title"
                        v-model="data.tipoReporte"></v-select>
                    </div>

                    <div v-for="(atributosform, indice) in printForm" :key="indice" >

                        <div >
                            <div v-if="atributosform.type =='id'" id="SelectVue" >
                                
                                <label name="labelSelectVue"> {{atributosform.label}} </label>
                                <v-select :options="data[atributosform.idd]" label="title"
                                v-model="form[atributosform.idd]"
                                :class="{'bg-gray-200 text-white' : form[atributosform.idd] == data.valorInactivo}"
                                ></v-select>
                                <InputError class="mt-2" :message="form.errors[atributosform.idd]" />

                            </div>
                            <div v-else-if="atributosform.type =='time'" id="SelectVue">
                                <InputLabel 
                                    :for="atributosform.label" :value="lang().label[atributosform.label]" />
                                <TextInput
                                    :id="atributosform.idd" :type="atributosform.type" class="mt-1 block w-full"
                                    v-model="form[atributosform.idd]" required :placeholder="atributosform.label"
                                    :error="form.errors[atributosform.idd]" 
                                    step="3600"
                                />
                                <InputError class="mt-2" :message="form.errors[atributosform.idd]" />
                            </div>
                            <div v-else class="">
                                <InputLabel
                                    :for="atributosform.label" :value="lang().label[atributosform.label]" />
                                <TextInput
                                    :id="atributosform.idd" :type="atributosform.type" class="mt-1 block w-full"
                                    v-model="form[atributosform.idd]" required :placeholder="atributosform.label"
                                    :error="form.errors[atributosform.idd]" />
                                    <InputError class="mt-2" :message="form.errors[atributosform.idd]" />
                            </div>
                        </div>
                    </div>

                    <!-- limite_token_general -->


                    <!-- pass -->
                    <!-- <div>
                        <InputLabel for="password" :value="lang().label.password" />
                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            :placeholder="lang().placeholder.password" :error="form.errors.password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    <div>
                        <InputLabel for="password_confirmation" :value="lang().label.password_confirmation" />
                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            v-model="form.password_confirmation" :placeholder="lang().placeholder.password_confirmation"
                            :error="form.errors.password_confirmation" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div> -->

                </div>
                <div class=" my-8 flex justify-end">
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