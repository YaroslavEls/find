<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ProfileNav from '@/Components/ProfileNav.vue';
import Public from '@/Pages/Saloon/Partials/Public.vue';
import Vacancies from '@/Pages/Saloon/Partials/Vacancies.vue';
import Locations from '@/Pages/Saloon/Partials/Locations.vue';
import { Head, useRemember } from '@inertiajs/vue3';

defineProps({
    saloon: {
        type: Object,
        required: true
    },
    vacancies: {
        type: Array,
        required: true
    },
    locations: {
        type: Array,
        required: true
    }
});

const tabs = {Public, Vacancies, Locations};
const names = {
    'Public': 'Профіль',
    'Vacancies': 'Вакансії',
    'Locations': 'Локації'
};
const current = useRemember('Public');

</script>

<template>
    <Head title="Profile" />

    <MainLayout>
        <ProfileNav
            :names="names"
            v-model="current"
        />

        <component 
            :is="tabs[current]"
            :saloon="saloon"
            :vacancies="vacancies"
            :locations="locations"
        />
    </MainLayout>
</template>
