<script setup>
import { ref } from 'vue';
import { useMq } from 'vue3-mq';

const props = defineProps({
    identifier: {
        type: String,
        required: true
    },
    allowed: {
        type: String,
        required: true
    },
    original: {
        type: String,
        required: true
    },
    button: {
        type: String,
        required: true
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

const current = ref(props.original);

const updatePhoto = (e) => {
    const file = e.target.files[0];
    current.value = URL.createObjectURL(file);
    model.value = file;
};

</script>

<template>
    <div
        class="w-full border-solid border-2 border-gray50 rounded-xl image"
        :class="mq.desktop ? 'h-[448px] mb-4' : 'h-[202px] mb-2'"
        :style="{ backgroundImage: `url('${current}')` }"
    />

    <label 
        :for="identifier" 
        class="block text-blue40 text-right txt-text-buttons cursor-pointer"
        :class="mq.desktop ? 'mb-8' : 'mb-10'"
    >
        {{ button }}
    </label>

    <input
        :id="identifier"
        type="file"
        :accept="allowed"
        @input="updatePhoto"
    >

    <div v-if="error" class="h-6 text-systemred txt-secondary">
        {{ error }}
    </div>
</template>
