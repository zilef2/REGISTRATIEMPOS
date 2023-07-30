<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { watchEffect } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';

const props = defineProps({
    show: Boolean,
    title: String,
    generica: Object,
})

const emit = defineEmits(["close"]);

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
    'calendario_id',
    'pieza_id',
    'reproceso_id',
]; const form = useForm({ ...Object.fromEntries(justNames.map(field => [field, ''])) });
const printForm = [
    { idd: 'codigo', label: 'codigo', type: 'text', value: form.codigo },
    { idd: 'cantidad', label: 'cantidad', type: 'text', value: form.cantidad },
    { idd: 'fecha', label: 'fecha', type: 'text', value: form.fecha },
    { idd: 'hora_inicial', label: 'hora_inicial', type: 'text', value: form.hora_inicial },
    { idd: 'hora_final', label: 'hora_final', type: 'text', value: form.hora_final },
];

const update = () => {
    form.put(route('reporte.update', props.reporte?.id), {
        preserveScroll: true,
        onSuccess: () => {
            emit("close")
            form.reset()
        },
        onError: () => null,
        onFinish: () => null,
    })
}

watchEffect(() => {
    if (props.show) {
        form.errors = {}
        form.codigo = props.reporte?.codigo
        form.cantidad = props.reporte?.cantidad
        form.fecha = props.reporte?.fecha
        form.hora_inicial = props.reporte?.hora_inicial
        form.hora_final = props.reporte?.hora_final
        form.actividad_id = props.reporte?.actividad_id
        form.centrotrabajo_id = props.reporte?.centrotrabajo_id
        form.disponibilidad_id = props.reporte?.disponibilidad_id
        form.material_id = props.reporte?.material_id
        form.operario_id = props.reporte?.operario_id
        form.ordentrabajo_id = props.reporte?.ordentrabajo_id
        form.calendario_id = props.reporte?.calendario_id
        form.pieza_id = props.reporte?.pieza_id
        form.reproceso_id = props.reporte?.reproceso_id

        form.errors = {}
    }
})

const sexos = [ { label: 'Masculino', value: 'Masculino' }, { label: 'Femenino', value: 'Femenino' } ];
const daynames = ['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom'];

</script>

<template>
    <section class="space-y-6">
        <Modal :show="props.show" @close="emit('close')">
            <form class="p-6 mb-12" @submit.prevent="update">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ lang().label.edit }} {{ props.title }}
                </h2>
                <div class="my-6 grid grid-cols-2 gap-6">
                    <div v-for="(atributosform, indice) in printForm" :key="indice">
                        <InputLabel :for="atributosform.label" :value="atributosform.value" />
                        <TextInput :id="atributosform.idd" :type="atributosform.type" class="mt-1 block w-full"
                            v-model="form[atributosform.idd]" required :placeholder="atributosform.label"
                            :error="form.errors[atributosform.idd]" />
                    </div>

                    <div>
                        <InputLabel for="fecha_nacimiento" :value="lang().label.fecha_nacimiento" />
                        <VueDatePicker :is-24="false" :day-names="daynames" :format="formatToVue" :flow="flow" auto-apply
                            :enable-time-picker="false" id="fecha_nacimiento"
                            class="mt-1 block w-full" v-model="form.fecha_nacimiento" required
                            :placeholder="lang().placeholder.fecha_nacimiento" :error="form.errors.fecha_nacimiento" />
                        <InputError class="mt-2" :message="form.errors.fecha_nacimiento" />
                    </div>
                    <!-- todo: aquiiii -->
                    <div>
                        <InputLabel for="sexo" :value="lang().label.sexo" />
                        <SelectInput id="sexo" class="mt-1 block w-full" v-model="form.sexo" required :dataSet="sexos"> </SelectInput>
                        <InputError class="mt-2" :message="form.errors.sexo" />
                    </div>

                </div>
                <div class="flex justify-end">
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
