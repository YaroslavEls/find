<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import SaloonHead from '@/Components/SaloonHead.vue';
import SaloonNav from '@/Components/SaloonNav.vue';
import Description from '@/Pages/Saloon/Partials/Description.vue';
import Reviews from '@/Pages/Saloon/Partials/Reviews.vue';
import Vacancies from '@/Pages/Saloon/Partials/Vacancies.vue';
import Locations from '@/Pages/Saloon/Partials/Locations.vue';
import { Head, useRemember, usePage } from '@inertiajs/vue3';

const props = defineProps({
    breadcrumbs: {
        type: Array,
        required: true
    },
    section: {
        type: [String, null],
        required: false,
        default: null
    },
    saloon: {
        type: Object,
        required: true
    },
    reviews: {
        type: Array,
        required: true
    }
});

const names = {
    'description': 'Опис',
    'reviews': 'Відгуки',
    'vacancies': 'Вакансії',
    'locations': 'Локації'
};
const current = useRemember(props.section ?? 'description');

const isSeeker = usePage().props.auth.user.userable_type === 'App\\Models\\Seeker';

</script>

<template>
    <Head :title="saloon.name" />

    <MainLayout>
        <Breadcrumbs 
            :items="breadcrumbs"
        />

        <SaloonHead
            :saloon="saloon"
        />

        <SaloonNav
            :names="names"
            v-model="current"
        />

        <Transition>
            <Description
                v-if="current === 'description'"
                :saloon="saloon"
            />
        </Transition>

        <Transition>
            <Reviews
                v-if="current === 'reviews'"
                :saloon="saloon"
                :reviews="reviews"
                :isSeeker="isSeeker"
            />
        </Transition>

        <Transition>
            <Vacancies
                v-if="current === 'vacancies'"
                :saloon="saloon"
                :locations="saloon.locations"
                :vacancies="saloon.vacancies"
                :isSeeker="isSeeker"
            />
        </Transition>

        <Transition>
            <Locations
                v-if="current === 'locations'"
                :locations="saloon.locations"
                :isSeeker="isSeeker"
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