<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ListingNav from '@/Components/ListingNav.vue';
import SeekerItem from '@/Components/SeekerItem.vue';
import Pagination from '@/Components/Pagination.vue';
import { ref } from 'vue';

defineProps({
    seekers: {
        type: Object,
        required: true
    }
});

const selected = ref(null);

</script>

<template>
    <MainLayout>
        <ListingNav
            heading="Кандидати"
            :count="seekers.total"
            route="seekers"
        />

        <SeekerItem
            v-for="seeker in seekers.data"
            :key="seeker.id"
            :seeker="seeker"
            v-model="selected"
        />

        <Pagination
            :count="seekers.last_page"
            :links="seekers.links"
        />
    </MainLayout>
</template>
