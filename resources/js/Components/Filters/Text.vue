<script setup>
defineProps({
    type: {
        type: String,
        required: false,
        default: 'text'
    },
    placeholder: {
        type: String,
        required: true
    }
});

const model = defineModel({
    type: [String, null],
    required: true
});

</script>

<template>
    <input
        :type="type"
        :placeholder="placeholder"
        v-model="model" 
        class="p-4 w-full bg-gray70 border-solid border-2 border-gray40 rounded-lg text-gray0 txt-body"
    >
</template>
