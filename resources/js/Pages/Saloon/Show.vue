<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import SaloonNav from '@/Components/SaloonNav.vue';
import Description from '@/Pages/Saloon/Partials/Description.vue';
import Reviews from '@/Pages/Saloon/Partials/Reviews.vue';
import Vacancies from '@/Pages/Saloon/Partials/Vacancies.vue';
import Locations from '@/Pages/Saloon/Partials/Locations.vue';
import { Head, useRemember } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
// import {ref} from 'vue';

defineProps({
    breadcrumbs: {
        type: Array,
        required: true
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
    'Description': 'Опис',
    'Reviews': 'Відгуки',
    'Vacancies': 'Вакансії',
    'Locations': 'Локації'
};
const current = useRemember('Description');

</script>

<template>
    <Head title="Profile" />

    <MainLayout>
        <Breadcrumbs 
            :items="breadcrumbs"
            class="mt-16 mb-12"
        />

        <div class="flex items-center gap-6">
            <img
                :src="'/' + saloon.logo"
                class="w-16 h-16 border-solid border-2 border-gray50 rounded-full"
            >
            <div>
                <div class="txt-h1">{{ saloon.name }}</div>
                <div class="flex gap-1 mt-2">
                    <div
                        v-for="x in 5"
                        :key="x"
                        class="icon-star-small"
                        :class="saloon.score < x ? 'gray' : ''"
                    />
                </div>
            </div>
        </div>

        <SaloonNav
            :names="names"
            v-model="current"
        />

        <Transition>
            <Description
                v-if="current === 'Description'"
                :saloon="saloon"
                class="mb-20"
            />
        </Transition>

        <Transition>
            <Reviews
                v-if="current === 'Reviews'"
                :saloon="saloon"
                :reviews="reviews"
                class="mb-20"
            />
        </Transition>

        <Transition>
            <Vacancies
                v-if="current === 'Vacancies'"
                :saloon="saloon"
                :locations="saloon.locations"
                :vacancies="saloon.vacancies"
                class="mb-20"
            />
        </Transition>

        <Transition>
            <Locations
                v-if="current === 'Locations'"
                :locations="saloon.locations"
                class="mb-20"
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