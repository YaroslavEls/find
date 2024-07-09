<script setup>
import LocationItem from '@/Components/LocationItem.vue';
import CreateNewButton from '@/Components/CreateNewButton.vue';
import { ref } from 'vue';

defineProps({
    locations: {
        type: Object,
        required: true
    }
});

const selected = ref(null);

</script>

<template>
    <div class="relative">
        <LocationItem
            v-for="(loc, index) in locations"
            :key="index"
            :location="loc"
            :index="index"
            v-model="selected"
        />

        <CreateNewButton
            routeName="location.create"
            text="Додати локацію"
        />
    </div>
</template>
