<script setup>
import EmptyListing from '@/Components/EmptyListing.vue';
import VacancyItem from '@/Components/VacancyItem.vue';
import CreateNewButton from '@/Components/CreateNewButton.vue';
import Confirm from '@/Components/Modals/Confirm.vue';
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
const modal = ref(null);

</script>

<template>
    <div class="relative">
        <CreateNewButton
            v-if="$page.url.startsWith('/profile')"
            routeName="vacancy.create"
            text="Додати вакансію"
            :disabled="locations.length === 0"
        />

        <EmptyListing v-if="vacancies.length === 0" />

        <VacancyItem
            v-for="vac in vacancies"
            :key="vac.id"
            :vacancy="vac"
            :index="vac.id"
            :isSeeker="isSeeker"
            v-model:selected="selected"
            v-model:modal="modal"
        />

        <Confirm
            title="Видалити вакансію?"
            subtitle="Видалену вакансію неможливо буде відновити. Ви впевнені що бажаєте видалити вакансію?"
            v-show="modal"
            v-model="modal"
        />
    </div>
</template>
