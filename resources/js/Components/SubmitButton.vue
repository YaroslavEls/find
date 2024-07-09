<script setup>
defineProps({
    text: {
        type: String,
        required: true
    },
    regular: {
        type: Boolean
    }
});

</script>

<template>
    <button
        :type="regular ? 'button' : 'submit'" 
        class="py-4 w-full text-center bg-blue50 rounded-xl txt-buttons"
    >
        {{ text }}
    </button>    
</template>
