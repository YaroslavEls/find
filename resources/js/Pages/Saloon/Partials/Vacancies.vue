<script setup>
import VacancyItem from '@/Components/VacancyItem.vue';
import CreateNewButton from '@/Components/CreateNewButton.vue';
import { ref } from 'vue';

defineProps({
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
    },
    isSeeker: {
        type: Boolean,
        required: true
    }
});

const selected = ref(null);

</script>

<template>
    <div class="relative">
        <VacancyItem
            v-for="(vac, index) in vacancies"
            :key="index"
            :vacancy="vac"
            :location="locations.find(loc => loc.id === vac.location_id)"
            :saloon="saloon"
            :index="index"
            :isSeeker="isSeeker"
            v-model="selected"
        />

        <CreateNewButton
            v-if="$page.url.startsWith('/profile')"
            routeName="vacancy.create"
            text="Додати вакансію"
        />
    </div>
</template>
