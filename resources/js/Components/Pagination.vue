<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    count: {
        type: Number,
        required: true
    },
    links: {
        type: Array,
        required: true
    }
});

</script>

<template>
    <div 
        v-if="count > 1"
        class="flex justify-center gap-4 mt-20"
    >
        <Link
            v-for="(item, index) in links.slice(1, -1)"
            :key="index"
            :href="item.url ? item.url : ''"
            class="w-10 h-10 py-2 rounded-lg text-center txt-body"
            :class="[item.active ? 'bg-blue50' : 'bg-gray50', item.url ? '' : 'pointer-events-none']"
        >
            {{ item.label }}
        </Link>
    </div>
</template>
