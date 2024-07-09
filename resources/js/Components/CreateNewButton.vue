<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    routeName: { 
        type: String,
        required: true 
    },
    text: { 
        type: String,
        required: true 
    }
});

</script>

<template>
    <Link
        :href="route(routeName)" 
        preserve-state 
        class="absolute top-[-97px] right-0 flex gap-2 px-6 py-2 bg-blue50 rounded txt-body"
    >
        {{ text }}
        <div class="icon-add" />
    </Link>
</template>
