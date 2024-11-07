<script setup>
import { MqResponsive } from "vue3-mq";

defineProps({
    saloon: {
        type: Object,
        required: true
    }
});

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <div class="flex justify-between gap-8">
                <div class="w-[880px]">
                    <div class="mb-4 text-gray40 txt-h3">Про кав’ярню (мережу):</div>
                    <div class="whitespace-pre-wrap txt-body">{{ saloon.descr }}</div>
                </div>

                <div class="w-[576px]">
                    <div class="mb-4 text-gray40 txt-h3">Соціальні мережі:</div>
                    <div class="txt-body">{{ saloon.socials }}</div>
                </div>
            </div>
        </template>

        <template #mobile>
            <div class="mb-2 text-gray40 txt-body">Соціальні мережі:</div>
            <div class="mb-8">
                <div
                    v-for="(item, index) in saloon.socials.split(';')"
                    :key="index"
                    class="mb-4 txt-body"
                >
                    {{ item }}
                </div>
            </div>
            <div class="mb-2 text-gray40 txt-h3">Про кав’ярню (мережу):</div>
            <div class="whitespace-pre-wrap txt-body">{{ saloon.descr }}</div>
        </template>
    </MqResponsive>
</template>
