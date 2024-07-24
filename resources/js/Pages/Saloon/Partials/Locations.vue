<script setup>
import LocationItem from '@/Components/LocationItem.vue';
import CreateNewButton from '@/Components/CreateNewButton.vue';
import { ref } from 'vue';

defineProps({
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
        <LocationItem
            v-for="(loc, index) in locations"
            :key="index"
            :location="loc"
            :index="index"
            :isSeeker="isSeeker"
            v-model="selected"
        />

        <CreateNewButton
            v-if="$page.url.startsWith('/profile')"
            routeName="location.create"
            text="Додати локацію"
        />
    </div>
</template>
