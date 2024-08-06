<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';
import { useMq } from "vue3-mq";

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

const mq = useMq();

</script>

<template>
    <InputLayout>
        <template #heading>{{ heading }}</template>

        <template #default>
            <input
                :type="type"
                :placeholder="placeholder"
                v-model="model" 
                class="px-4 w-full bg-background border-solid rounded-lg text-gray0 txt-body"
                :class="[
                    error ? 'border-systemred' : 'border-gray40', 
                    mq.desktop ? 'py-4 border-2' : 'py-[14px] border'
                ]"
            >
        </template>
        
        <template v-if="note" #note>{{ note }}</template>
        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
