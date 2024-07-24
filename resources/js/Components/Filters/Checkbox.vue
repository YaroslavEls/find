<script setup>
defineProps({
    text: {
        type: String,
        required: true
    }
});

const model = defineModel({
    type: Boolean,
    required: true
});

</script>

<template>
    <div
        @click="model = !model"
        class="flex gap-2 w-fit mb-4 cursor-pointer"
    >
        <div 
            class="w-6 h-6 rounded bg-gray50"
            :class="model ? 'icon-checkbox' : ''"
        />
        <div class="txt-secondary">{{ text }}</div>
    </div>
</template>
