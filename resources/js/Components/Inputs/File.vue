<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';
import { computed } from 'vue';
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
    deletable: {
        type: Boolean,
        default: false
    },
    note: { 
        type: String
    },
    error: {
        type: String
    }
});

const model = defineModel({
    type: [File, String, null],
    required: true
});

const mq = useMq();

const clear = () => {
    model.value = null;
};

const inputEvent = (e) => {
    model.value = e.target.files[0];
};

const filename = computed(() => {
    if (model.value) {
        if (typeof model.value === 'string') {
            return model.value.split('/')[1];
        } else {
            return model.value.name;
        }
    } else {
        return props.button;
    }
});

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

            <div
                v-if="deletable"
                @click="clear"
                class="flex gap-2 items-center w-fit mt-2 ml-auto txt-text-buttons"
                :class="model ? 'text-systemred cursor-pointer' : 'text-gray40'"
            >
                Видалити
                <div class="icon-delete" :class="model ? 'red' : 'gray opacity-50'" />
            </div>
        </template>

        <template v-if="note" #note>{{ note }}</template>
        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
