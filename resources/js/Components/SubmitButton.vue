<script setup>
import { useMq } from "vue3-mq";

defineProps({
    text: {
        type: String,
        required: true
    },
    regular: {
        type: Boolean
    }
});

const mq = useMq();

</script>

<template>
    <button
        :type="regular ? 'button' : 'submit'" 
        class="w-full text-center bg-blue50 rounded-lg txt-buttons"
        :class="mq.desktop ? 'py-4' : 'py-3'"
    >
        {{ text }}
    </button>   
</template>
