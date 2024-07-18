<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ListingNav from '@/Components/ListingNav.vue';
import SeekerItem from '@/Components/SeekerItem.vue';
import { ref } from 'vue';

defineProps({
    seekers: {
        type: Array,
        required: true
    }
});

const selected = ref(null);

</script>

<template>
    <MainLayout>
        <ListingNav
            heading="Кандидати"
            :count="seekers.length"
        />

        <SeekerItem
            v-for="seeker in seekers"
            :key="seeker.id"
            :seeker="seeker"
            v-model="selected"
        />
    </MainLayout>
</template>
