<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useMq } from 'vue3-mq';

const mq = useMq();

const path = window.location.origin + window.location.pathname;
const urlParams = new URLSearchParams(window.location.search);
const sort = ref(urlParams.get('sort'));

</script>

<template>
    <div 
        class="flex justify-between items-center"
        :class="mq.desktop ? 'mb-14' : 'mb-8'"
    >
        <div class="txt-h1">Чати</div>
        <div class="flex gap-2">
            <Link
                :href="path"
                class="h-fit rounded txt-body"
                :class="[
                    sort !== 'archive' ? 'bg-blue50' : 'bg-gray60',
                    mq.desktop ? 'px-6 py-2' : 'px-[14px] py-1'
                ]"
            >
                Усі
            </Link>
            <Link
                :href="path + '?sort=archive'"
                class="h-fit rounded txt-body"
                :class="[
                    sort === 'archive' ? 'bg-blue50' : 'bg-gray60',
                    mq.desktop ? 'px-6 py-2' : 'px-[14px] py-1'
                ]"
            >
                Архів
            </Link>
        </div>
    </div>
</template>
