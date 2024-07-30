<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const path = window.location.origin + window.location.pathname;
const urlParams = new URLSearchParams(window.location.search);
const sort = ref(urlParams.get('sort'));

</script>

<template>
    <div class="flex justify-between items-center mb-14">
        <div class="txt-h1">Чати</div>
        <div class="flex gap-2">
            <Link
                :href="path"
                class="px-6 py-2 h-fit rounded txt-body"
                :class="sort !== 'archive' ? 'bg-blue50' : 'bg-gray50'"
            >
                Усі
            </Link>
            <Link
                :href="path + '?sort=archive'"
                class="px-6 py-2 h-fit rounded txt-body"
                :class="sort === 'archive' ? 'bg-blue50' : 'bg-gray50'"
            >
                Архів
            </Link>
        </div>
    </div>
</template>
