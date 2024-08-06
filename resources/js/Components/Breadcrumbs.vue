<script setup>
import { Link } from '@inertiajs/vue3';
import { useMq } from "vue3-mq";

defineProps({
    items: {
        type: Array,
        required: true
    }
});

const mq = useMq();

</script>

<template>
    <div 
        class="flex flex-wrap items-center"
        :class="mq.desktop ? 'gap-2 mb-12' : 'gap-1 mb-6'"
    >
        <div
            v-for="(item, index) in items"
            :key="index"
            class="flex items-center"
            :class="mq.desktop ? 'gap-2' : 'gap-1'"
        >
            <Link
                :href="item.url"
                class="txt-h4"
                :class="index === items.length - 1 ? 'text-gray-0' : 'text-gray40'"
            >
                {{ item.title }}
            </Link>

            <div
                v-show="index !== items.length - 1"
                class="icon-bread"
                :class="index !== items.length - 2 ? 'gray' : ''"
            />
        </div>
    </div>
</template>
