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
        <CreateNewButton
            v-if="$page.url.startsWith('/profile')"
            routeName="vacancy.create"
            text="Додати вакансію"
        />

        <VacancyItem
            v-for="vac in vacancies"
            :key="vac.id"
            :vacancy="vac"
            :index="vac.id"
            :isSeeker="isSeeker"
            v-model="selected"
        />
    </div>
</template>
