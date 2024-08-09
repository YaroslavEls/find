<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';
import { ref, onMounted } from 'vue';
import { useMq } from "vue3-mq";

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

const mq = useMq();

const textarea = ref(null);

const resize = () => {
    const posY = window.scrollY;
    textarea.value.style.height = 'auto';
    textarea.value.style.height = (textarea.value.scrollHeight + 5) + 'px';
    window.scrollTo(0, posY);
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
                class="max-h-[500px] px-4 w-full bg-background border-solid rounded-lg txt-body"
                :class="[
                    error ? 'border-systemred' : 'border-gray40',
                    mq.desktop ? 'py-4 border-2' : 'py-[14px] border'    
                ]"
            ></textarea>
        </template>

        <template v-if="note" #note>{{ note }}</template>
        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
