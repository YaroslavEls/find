<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    items: {
        type: Array,
        required: true
    }
});

</script>

<template>
    <div class="flex gap-2 items-center">
        <div
            v-for="(item, index) in items"
            :key="index"
            class="flex gap-2 items-center"
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
