<script setup>
import { Link } from '@inertiajs/vue3';
import { useMq } from 'vue3-mq';

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

const mq = useMq();

</script>

<template>
    <div 
        v-if="count > 1"
        class="flex justify-center"
        :class="mq.desktop ? 'gap-4 mt-20' : 'gap-2 mt-12'"
    >
        <Link
            v-for="(item, index) in links.slice(1, -1)"
            :key="index"
            :href="item.url ? item.url : ''"
            class="rounded-lg text-center txt-body"
            :class="[
                item.active ? 'bg-blue50' : 'bg-gray50', 
                item.url ? '' : 'pointer-events-none',
                mq.desktop ? 'w-10 h-10 py-2' : 'w-8 h-8 py-[6px]'
            ]"
        >
            {{ item.label }}
        </Link>
    </div>
</template>
