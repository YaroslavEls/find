<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ListingNav from '@/Components/ListingNav.vue';
import VacancyItem from '@/Components/VacancyItem.vue';
import { ref } from 'vue';

defineProps({
    vacancies: {
        type: Array,
        required: true
    }
});

const selected = ref(null);

</script>

<template>
    <MainLayout>
        <ListingNav
            heading="Вакансії"
            :count="vacancies.length"
        />

        <VacancyItem
            v-for="(vacancy, index) in vacancies"
            :key="vacancy.id"
            :vacancy="vacancy"
            :index="index"
            v-model="selected"
        />
    </MainLayout>
</template>
