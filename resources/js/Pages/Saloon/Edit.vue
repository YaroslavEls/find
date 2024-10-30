<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ProfileNav from '@/Components/ProfileNav.vue';
import Public from '@/Pages/Saloon/Partials/Public.vue';
import Vacancies from '@/Pages/Saloon/Partials/Vacancies.vue';
import Locations from '@/Pages/Saloon/Partials/Locations.vue';
import { Head, useRemember } from '@inertiajs/vue3';

const props = defineProps({
    section: {
        type: String,
        required: false
    },
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

const names = {
    'public': 'Профіль',
    'vacancies': 'Вакансії',
    'locations': 'Локації'
};
const current = useRemember(props.section ?? 'public');

</script>

<template>
    <Head title="Профіль" />

    <MainLayout>
        <ProfileNav
            :names="names"
            v-model="current"
        />

        <Transition>
            <Public
                v-if="current === 'public'"
                :saloon="saloon"
            />
        </Transition>

        <Transition>
            <Vacancies
                v-if="current === 'vacancies'"
                :saloon="saloon"
                :locations="locations"
                :vacancies="vacancies"
                :isSeeker="true"
            />
        </Transition>

        <Transition>
            <Locations
                v-if="current === 'locations'"
                :locations="locations"
            />
        </Transition>

    </MainLayout>
</template>

<style scoped>
.v-enter-active {
  transition: opacity 0.5s ease-out;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
