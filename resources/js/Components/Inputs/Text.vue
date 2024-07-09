<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';

defineProps({
    type: {
        type: String,
        required: true
    },
    placeholder: {
        type: String
    },
    heading: {
        type: String,
        required: true
    },
    error: {
        type: String
    }
});

const model = defineModel({
    type: [String, null],
    required: true
});

</script>

<template>
    <InputLayout>
        <template #heading>{{ heading }}</template>

        <template #default>
            <input
                :type="type"
                :placeholder="placeholder"
                v-model="model" 
                class="p-4 w-full bg-background border-solid border-2 rounded-lg text-gray0 txt-body"
                :class="error ? 'border-systemred' : 'border-gray40'"
            >
        </template>
        
        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
