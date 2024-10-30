<script setup>
import FormContent from '@/Pages/Location/Partials/FormContent.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const model = defineModel({
    type: Object,
    required: true 
});
const current = defineModel('current', {
    type: Number,
    required: true
});

const form = useForm({
    name: null,
    city: 'Київ',
    address: null,
    schedule: [null, null, null, null, null, null, null],
    gen: false,
    photos: [],
    video: null
});

const submit = () => {
    form.post(route('location.validate'), {
        onSuccess: () => {
            model.value.locations.push(form.data());
            form.reset();
            current.value = --current.value;
        }
    });
};

const allow = computed(() => {
    const data = form.data();
    delete data['video'];

    if (data.photos.length === 0) return false;

    const values = Object.values(data);
    for (let i = 0; i < values.length; i++) {
        if (values[i] === null || values[i] === '') return false;
    }
    return true;
});

</script>

<template>
    <form @submit.prevent="submit">
        <FormContent
            v-model="form"
        />
        <SubmitButton 
            text="Створити"
            :class="allow ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
        />
    </form>
</template>
