<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import FormContent from '@/Pages/Location/Partials/FormContent.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: null,
    city: null,
    address: null,
    schedule: [null, null, null, null, null, null, null],
    photos: [],
    video: null 
});

const submit = () => {
    form.post(route('location.store'), {
        onError: () => console.log(form)
    });
};

</script>

<template>
    <MainLayout>
        <Head title="Add a Location" />

        <form @submit.prevent="submit" class="w-[576px] mt-6 mb-32 mx-auto">
            <BackButton />

            <div class="mb-10 txt-h1">Додавання локації</div>

            <FormContent 
                v-model="form"
            />

            <SubmitButton
                text="Створити"
            />
        </form>
    </MainLayout>
</template>
