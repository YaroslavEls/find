<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import FormContent from '@/Pages/Vacancy/Partials/FormContent.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';

const form = useForm({
    location: null,
    location_id: null,
    job: null,
    employment: [],
    salary: null,
    experience: 1,
    descr: null 
});

const submit = () => {
    const locs = usePage().props.auth.user.saloon.locations;
    const location = locs.find(item => item.name == form.location);
    form.location_id = location ? location.id : null;

    form.post(route('vacancy.store'), {
        onError: () => {
            console.log(form);
        }
    });
};

</script>

<template>
    <MainLayout>
        <Head title="Add a Location" />

        <form @submit.prevent="submit" class="w-[576px] mt-6 mb-32 mx-auto">
            <BackButton />

            <div class="mb-10 txt-h1">Створення вакансії</div>

            <FormContent
                v-model="form"
            />

            <SubmitButton
                text="Створити"
            />
        </form>
    </MainLayout>
</template>
