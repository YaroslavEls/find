<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ListingNav from '@/Components/ListingNav.vue';
import EmptyListing from '@/Components/EmptyListing.vue';
import VacancyItem from '@/Components/VacancyItem.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    vacancies: {
        type: Object,
        required: true
    }
});

const selected = ref(null);

const isSeeker = usePage().props.auth.user.userable_type === 'App\\Models\\Seeker';

</script>

<template>
    <Head title="Вакансії" />

    <MainLayout>
        <ListingNav
            heading="Вакансії"
            :count="vacancies.total"
            :isSeeker="isSeeker"
            route="vacancies"
        />

        <EmptyListing v-if="vacancies.data.length === 0" />

        <VacancyItem
            v-for="(vacancy, index) in vacancies.data"
            :key="vacancy.id"
            :vacancy="vacancy"
            :index="index"
            :isSeeker="isSeeker"
            v-model:selected="selected"
        />

        <Pagination
            :count="vacancies.last_page"
            :links="vacancies.links"
        />
    </MainLayout>
</template>
