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

// --------------------------- ** -------------------------

const props = defineProps({
    show: Boolean,
    title: String,
    roles: Object,
    titulos: Object, //parametros de la clase principal
    
    numberPermissions: Number,
})
const emit = defineEmits(["close"]);

const data = reactive({
    params: {
        pregunta: ''
    },
})

//very usefull
const justNames = props.titulos.map(names => names['order'] )
const form = useForm({ ...Object.fromEntries(justNames.map(field => [field, ''])) });
onMounted(() => {
    if(props.numberPermissions > 8){

        const valueRAn = Math.floor(Math.random() * (9 - 0) + 1)
        form.nombre = 'admin orden trabajo '+ (valueRAn);
        form.codigo = (valueRAn);
        // form.hora_inicial = '0'+valueRAn+':00'//temp
        // form.fecha = '2023-06-01'

    }
});

const printForm =[];
props.titulos.forEach(names => 
    printForm.push ({
        idd: names['order'], label: names['label'], type: names['type']
        //, value: form[names['order']]
    })
);

// const printForm = [
//     { idd: justNames[0], label: 'codigo', type: 'text', value: form.codigo , elif:null},
//     { idd: 'nombre', label: 'nombre', type: 'text', value: form.nombre , elif:null},
// ];
// console.log("🧈✅ debu son iguales:", JSON.stringify(printForm) === JSON.stringify(printForm2));

const create = () => {
    // console.log("🧈 debu pieza_id:", form.pieza_id);
    form.post(route('centrotrabajo.store'), {
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
    }
})


// const roles = props.roles?.map(role => ({
//     label: role.name.replace(/_/g, " "),
//     value: (role.name)
// }))

//very usefull
const sexos = [{ label: 'Masculino', value: 0 }, { label: 'Femenino', value: 1 }];
</script>

<template>
    <section class="space-y-6">
        <Modal :show="props.show" @close="emit('close')">
            <form class="p-6" @submit.prevent="create">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ lang().label.add }} {{ props.title }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div v-for="(atributosform, indice) in printForm" :key="indice">



                        <!-- si es foreign -->
                        <div v-if="atributosform.type == 'id'" id="SelectVue">
                            <label name="labelSelectVue"> {{ atributosform.label }} </label>
                            <v-select :options="data[atributosform.idd]" label="title"
                                v-model="form[atributosform.idd]"></v-select>
                            <InputError class="mt-2" :message="form.errors[atributosform.idd]" />

                        </div>


                        <!-- tiempo -->
                        <div v-else-if="atributosform.type == 'time'" id="SelectVue">
                            <InputLabel :for="atributosform.label" :value="lang().label[atributosform.label]" />
                            <TextInput :id="atributosform.idd" :type="atributosform.type" class="mt-1 block w-full"
                                v-model="form[atributosform.idd]" required :placeholder="atributosform.label"
                                :error="form.errors[atributosform.idd]" step="3600" />
                            <InputError class="mt-2" :message="form.errors[atributosform.idd]" />
                        </div>


                        <!-- normal -->
                        <div v-else class="">
                            <InputLabel :for="atributosform.label" :value="lang().label[atributosform.label]" />
                            <TextInput :id="atributosform.idd" :type="atributosform.type" class="mt-1 block w-full"
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
                        @click="create">
                        {{ lang().button.add }} {{ form.processing ? + '...' : '' }}
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