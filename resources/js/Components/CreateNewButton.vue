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
    },
    disabled: {
        type: Boolean,
        required: false,
        default: false
    }
});

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <Link
                v-if="!disabled"
                :href="route(routeName)" 
                preserve-state 
                class="absolute top-[-97px] right-0 flex gap-2 px-6 py-2 bg-blue50 rounded txt-body"
            >
                {{ text }}
                <div class="icon-add" />
            </Link>
            <div
                v-else
                title="Для створення вакансії необхідно створити хоча б 1 локацію."
                class="absolute top-[-97px] right-0 flex gap-2 px-6 py-2 bg-gray70 rounded text-gray40 txt-body cursor-not-allowed"
            >
                {{ text }}
                <div class="icon-add gray" />
            </div>
        </template>

        <template #mobile>
            <Link
                v-if="!disabled"
                :href="route(routeName)" 
                preserve-state 
                class="flex justify-center gap-2 w-full mb-8 py-3 bg-blue50 rounded-lg txt-buttons"
            >
                {{ text }}
                <div class="icon-add" />
            </Link>
            <div
                v-else
                title="Для створення вакансії необхідно створити хоча б 1 локацію."
                class="flex justify-center gap-2 w-full mb-8 py-3 bg-gray70 rounded-lg text-gray40 txt-buttons"
            >
                {{ text }}
                <div class="icon-add gray" />
            </div>
        </template>
    </MqResponsive>
</template>
