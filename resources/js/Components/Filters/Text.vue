<script setup>
import { useMq } from 'vue3-mq';

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

const mq = useMq();

</script>

<template>
    <input
        :type="type"
        :placeholder="placeholder"
        v-model="model" 
        class="px-4 w-full bg-gray70 border-solid border-gray40 rounded-lg text-gray0 txt-body"
        :class="mq.desktop ? 'py-4 border-2' : 'py-[14px] border'"
    >
</template>
