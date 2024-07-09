<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ProfileNav from '@/Components/ProfileNav.vue';
import Public from '@/Pages/Saloon/Partials/Public.vue';
import Vacancies from '@/Pages/Saloon/Partials/Vacancies.vue';
import Locations from '@/Pages/Saloon/Partials/Locations.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    saloon: {
        type: Object,
        required: true
    },
    vacancies: {
        type: Object,
        required: true
    },
    locations: {
        type: Object,
        required: true
    }
});

const tabs = {Public, Vacancies, Locations};
const names = {
    'Public': 'Профіль',
    'Vacancies': 'Вакансії',
    'Locations': 'Локації'
};
const current = ref('Public');

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
