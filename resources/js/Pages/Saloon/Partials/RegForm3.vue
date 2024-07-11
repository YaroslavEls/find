<script setup>
import FormContent from '@/Pages/Location/Partials/FormContent.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import { useForm } from '@inertiajs/vue3';

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
    city: null,
    address: null,
    schedule: [null, null, null, null, null, null, null],
    photos: [],
    video: null
});

const submit = () => {
    form.post(route('location.validate'), {
        onError: () => console.log(form),
        onSuccess: () => {
            model.value.locations.push(form.data());
            form.reset();
            current.value = --current.value;
        }
    });
};

</script>

<template>
    <form @submit.prevent="submit">
        <FormContent
            v-model="form"
        />
        <SubmitButton 
            text="Створити"
        />
    </form>
</template>
