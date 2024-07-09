<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';
import { ref, onMounted } from 'vue';

defineProps({
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

const textarea = ref(null);

const resize = () => {
    textarea.value.style.height = 'auto';
    textarea.value.style.height = (textarea.value.scrollHeight + 5) + 'px';
};

onMounted(() => {
    resize();
});

</script>

<template>
    <InputLayout>
        <template #heading>{{ heading }}</template>

        <template #default>
            <textarea
                :placeholder="placeholder"
                ref="textarea"
                @input="resize"
                v-model="model"
                class="max-h-[500px] p-4 w-full bg-background border-solid border-2 rounded-lg text-gray0 txt-body"
                :class="error ? 'border-systemred' : 'border-gray40'"
            ></textarea>
        </template>

        <template v-if="note" #note>{{ note }}</template>
        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
