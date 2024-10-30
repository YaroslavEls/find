<script setup>
import { useMq } from 'vue3-mq';

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

const mq = useMq();

</script>

<template>
    <div
        @click="model = !model"
        class="flex items-end gap-2 w-fit mb-4 cursor-pointer"
    >
        <div 
            class="rounded bg-gray60"
            :class="[
                model ? 'icon-checkbox' : '',
                mq.desktop ? 'w-6 h-6' : 'w-5 h-5'    
            ]"
        />
        <div class="txt-secondary">{{ text }}</div>
    </div>
</template>
