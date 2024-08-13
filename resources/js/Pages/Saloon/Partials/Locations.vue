<script setup>
import LocationItem from '@/Components/LocationItem.vue';
import CreateNewButton from '@/Components/CreateNewButton.vue';
import Confirm from '@/Components/Modals/Confirm.vue';
import { ref } from 'vue';

defineProps({
    locations: {
        type: Array,
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
            routeName="location.create"
            text="Додати локацію"
        />

        <LocationItem
            v-for="loc in locations"
            :key="loc.id"
            :location="loc"
            :index="loc.id"
            v-model:selected="selected"
            v-model:modal="modal"
        />

        <Confirm
            title="Видалити локацію?"
            subtitle="Видалену локацію неможливо буде відновити. Всі вакансії пов'язані з даною локацією також будуть видалені. Ви впевнені що бажаєте видалити локацію?"
            v-show="modal"
            v-model="modal"
        />
    </div>
</template>
