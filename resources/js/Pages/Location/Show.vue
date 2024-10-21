<script setup>
import { MqResponsive } from "vue3-mq";
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import VacancyItem from '@/Components/VacancyItem.vue';
import { Head, usePage } from '@inertiajs/vue3';
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
    <Head :title="location.name" />

    <MainLayout>
        <Breadcrumbs 
            :items="breadcrumbs"
        />

        <MqResponsive group>
            <template #desktop>
                <div class="flex items-center gap-4 mb-10">
                    <div class="txt-h1">Вакансії на цій локації:</div>
                    <div class="text-blue40 txt-h4">{{ location.name }}</div>
                </div>
            </template>

            <template #mobile>
                <div class="mb-2 txt-h2">Вакансії на цій локації:</div>
                <div class="mb-4 text-blue40 txt-h4">{{ location.name }}</div>
            </template>
        </MqResponsive>

        <VacancyItem
            v-for="(vac, index) in location.vacancies"
            :key="vac.id"
            :vacancy="vac"
            :index="index"
            :isSeeker="isSeeker"
            v-model:selected="selected"
        />
    </MainLayout>
</template>
