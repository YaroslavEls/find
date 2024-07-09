<script setup>
import { ref } from 'vue';

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

const current = ref(props.original);

const updatePhoto = (e) => {
    const file = e.target.files[0];
    current.value = URL.createObjectURL(file);
    model.value = file;
};

</script>

<template>
    <img 
        :src="current" 
        alt=""
        class="w-full h-[448px] mb-4 border-solid border-2 border-gray50 rounded-xl"
    >

    <label 
        :for="identifier" 
        class="block mb-8 text-blue40 text-right txt-text-buttons cursor-pointer"
    >
        {{ button }}
    </label>

    <input
        :id="identifier"
        type="file"
        :accept="allowed"
        @input="updatePhoto"
    >

    <div class="h-6 text-systemred txt-secondary">
        {{ error }}
    </div>
</template>
