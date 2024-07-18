<script setup>
defineProps({
    saloon: {
        type: Object,
        required: true
    }
});

</script>

<template>
    <div class="flex justify-between gap-8">
        <div class="w-[880px]">
            <div class="mb-4 text-gray40 txt-h3">Про кав’ярню (мережу):</div>
            <div class="txt-body">{{ saloon.descr }}</div>
        </div>

        <div class="w-[576px]">
            <div class="mb-4 text-gray40 txt-h3">Соціальні мережі:</div>
            <div class="txt-body">{{ saloon.socials }}</div>
        </div>
    </div>
</template>
