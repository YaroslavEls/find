<script setup>
import DropdownSingle from '@/Components/Inputs/DropdownSingle.vue';

defineProps({
    heading: {
        type: String,
        required: true
    },
    note: {
        type: String
    },
    error: {
        type: String
    }
});

const model = defineModel({
    type: [String, null],
    required: true
});

const res = await fetch('/storage/cities.json');
const data = await res.json();

</script>

<template>
    <DropdownSingle
        :heading="heading"
        :options="data"
        :note="note"
        :error="error"
        v-model="model"
    />
</template>
