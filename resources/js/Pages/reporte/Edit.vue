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

const props = defineProps({
    show: Boolean,
    title: String,
    generica: Object,
    losSelect: Object,

})

const emit = defineEmits(["close"]);
const data = reactive({
    justNames: [
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
        'calendario_id',
        'pieza_id',
        'reproceso_id'
    ],
    actividad_id:props.losSelect.actividad,
    centrotrabajo_id:props.losSelect.centrotrabajo,
    disponibilidad_id:props.losSelect.disponibilidad,
    material_id:props.losSelect.material,
    ordentrabajo_id:props.losSelect.ordentrabajo,
    pieza_id:props.losSelect.pieza,
    reproceso_id:props.losSelect.reproceso,
})

const form = useForm({ ...Object.fromEntries(data.justNames.map(field => [field, ''])) });
const printForm = [
    { idd: 'codigo', label: 'codigo', type: 'text', value: form.codigo , elif:null},
    { idd: 'fecha', label: 'fecha', type: 'date', value: form.fecha , elif:null},
    { idd: 'hora_inicial', label: 'hora inicial', type: 'time', value: form.hora_inicial , elif:null},
    // { idd: 'hora_final', label: 'hora final', type: 'time', value: form.hora_final , elif:null},
    
    { idd: 'actividad_id', label: 'Actividad', type: 'id', value: form.actividad_id , elif:null},
    { idd: 'centrotrabajo_id', label: 'Centrotrabajo', type: 'id', value: form.centrotrabajo_id , elif:null},
    { idd: 'material_id', label: 'Material', type: 'id', value: form.material_id , elif:null},
    { idd: 'ordentrabajo_id', label: 'Ordentrabajo', type: 'id', value: form.ordentrabajo_id , elif:null},

    { idd: 'pieza_id', label: 'Pieza', type: 'id', value: form.pieza_id, elif:null },
    { idd: 'cantidad', label: 'cantidad (pieza)', type: 'text', value: form.cantidad, elif:'pieza_id' },
    //opcionales
    { idd: 'disponibilidad_id', label: 'Disponibilidad', type: 'id', value: form.disponibilidad_id, elif:null },
    { idd: 'reproceso_id', label: 'Reproceso', type: 'id', value: form.reproceso_id, elif:null },

    // { idd: 'operario_id', label: 'Operario', type: 'id', value: form.operario_id },
];

watchEffect(() => {
    if (props.show) {
        // data.justNames.forEach(element => {
        //     form[element] =  props.generica[element]
        // });
        form.errors = {}
        form.codigo = props.generica?.codigo
        form.cantidad = props.generica?.cantidad
        form.fecha = props.generica?.fecha
        form.hora_inicial = props.generica?.hora_inicial
        form.hora_final = props.generica?.hora_final

        form.actividad_id = props.generica?.actividad_s
        form.centrotrabajo_id = props.generica?.centrotrabajo_s
        form.disponibilidad_id = props.generica?.disponibilidad_s
        form.material_id = props.generica?.material_s
        form.operario_id = props.generica?.operario_s
        form.ordentrabajo_id = props.generica?.ordentrabajo_s
        form.calendario_id = props.generica?.calendario_s
        form.pieza_id = props.generica?.pieza_s
        form.reproceso_id = props.generica?.reproceso_s
    }
})


const update = () => {
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

const sexos = [ { label: 'Masculino', value: 'Masculino' }, { label: 'Femenino', value: 'Femenino' } ];
const daynames = ['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom'];

</script>




















<template>
    <section class="space-y-6">
        <Modal :show="props.show" @close="emit('close')">
            <form class="p-6" @submit.prevent="create">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ lang().label.edit }} {{ props.title }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div v-for="(atributosform, indice) in printForm" :key="indice">
                        <div v-if="atributosform.type =='id'" id="SelectVue">
                            <label name="labelSelectVue"> {{atributosform.label}} </label>
                            <v-select :options="data[atributosform.idd]" label="title"
                            v-model="form[atributosform.idd]" :value="data[atributosform.idd][props.generica.actividad_id]"></v-select>
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
                <div class=" my-8 flex justify-end">
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