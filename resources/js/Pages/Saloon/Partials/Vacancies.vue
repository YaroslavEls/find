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
        type: Object,
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
            :location="vac.location"
            :saloon="saloon"
            :index="index"
            v-model="selected"
        />

        <CreateNewButton
            routeName="vacancy.create"
            text="Додати вакансію"
        />
    </div>
</template>
