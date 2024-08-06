<script setup>
import LocationItem from '@/Components/LocationItem.vue';
import CreateNewButton from '@/Components/CreateNewButton.vue';
import { ref } from 'vue';

defineProps({
    locations: {
        type: Array,
        required: true
    }
});

const selected = ref(null);

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
            v-model="selected"
        />
    </div>
</template>
