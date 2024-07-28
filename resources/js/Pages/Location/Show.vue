<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import VacancyItem from '@/Components/VacancyItem.vue';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    breadcrumbs: {
        type: Array,
        required: true
    },
    location: {
        type: Object,
        required: true
    }
});

const selected = ref(null);

const isSeeker = usePage().props.auth.user.userable_type === 'App\\Models\\Seeker';

</script>

<template>
    <MainLayout>
        <Breadcrumbs 
            :items="breadcrumbs"
            class="mb-12"
        />

        <div class="flex items-center gap-4 mb-10">
            <div class="txt-h1">Вакансії на цій локації:</div>
            <div class="text-blue40 txt-h4">{{ location.name }}</div>
        </div>

        <VacancyItem
            v-for="(vac, index) in location.vacancies"
            :key="index"
            :vacancy="vac"
            :index="index"
            :isSeeker="isSeeker"
            v-model="selected"
        />
    </MainLayout>
</template>
