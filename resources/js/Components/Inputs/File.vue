<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';
import { ref } from 'vue';
import { useMq } from "vue3-mq";

const props = defineProps({
    identifier: { 
        type: String, 
        required: true 
    },
    allowed: {
        type: String,
        required: true
    },
    heading: {
        type: String, 
        required: true
        },
    subheading: { 
        type: String
    },
    button: { 
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
    type: [File, null],
    required: true
});

const mq = useMq();

const inputEvent = (e) => {
    filename.value = e.target.files[0].name;
    model.value = e.target.files[0];
};

const filename = ref();
if (model.value) {
    if (typeof model.value === 'string') {
        filename.value = model.value.split('/')[1];
    } else {
        filename.value = model.value.name;
    }
} else {
    filename.value = props.button;
}

</script>

<template>
    <InputLayout>
        <template #heading>{{ heading }}</template>
        <template v-if="subheading" #subheading>{{ subheading }}</template>

        <template #default>
            <label 
                :for="identifier" 
                class="block w-full bg-background border-solid border-gray40 rounded-lg txt-buttons text-center cursor-pointer crop crop-1"
                :class="mq.desktop ? 'p-[15px] border-2' : 'p-3 border'"
            >
                {{ filename }}
            </label>

            <input
                :id="identifier"
                type="file"
                :accept="allowed"
                @input="inputEvent"
                class="txt-secondary"
            >
        </template>

        <template v-if="note" #note>{{ note }}</template>
        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
