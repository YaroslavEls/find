<script setup>
import { MqResponsive } from "vue3-mq";
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
    <MqResponsive group>
        <template #desktop>
            <Link
                :href="route(routeName)" 
                preserve-state 
                class="absolute top-[-97px] right-0 flex gap-2 px-6 py-2 bg-blue50 rounded txt-body"
            >
                {{ text }}
                <div class="icon-add" />
            </Link>
        </template>

        <template #mobile>
            <Link
                :href="route(routeName)" 
                preserve-state 
                class="flex justify-center gap-2 w-full mb-8 py-3 bg-blue50 rounded-lg txt-buttons"
            >
                {{ text }}
                <div class="icon-add" />
            </Link>
        </template>
    </MqResponsive>
</template>
